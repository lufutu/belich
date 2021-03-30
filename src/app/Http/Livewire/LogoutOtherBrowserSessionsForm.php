<?php

declare(strict_types=1);

namespace Daguilarm\Belich\App\Http\Livewire;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class LogoutOtherBrowserSessionsForm extends Component
{
    /**
     * Indicates if logout is being confirmed.
     *
     * @var bool
     */
    public $confirmingLogout = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Confirm that the user would like to log out from other browser sessions.
     */
    public function confirmLogout(): void
    {
        $this->password = '';

        $this->dispatchBrowserEvent('confirming-logout-other-browser-sessions');

        $this->confirmingLogout = true;
    }

    /**
     * Log out from other browser sessions.
     */
    public function logoutOtherBrowserSessions(StatefulGuard $guard): void
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $guard->logoutOtherDevices($this->password);

        $this->deleteOtherSessionRecords();

        $this->confirmingLogout = false;

        $this->emit('loggedOut');
    }

    /**
     * Get the current sessions.
     */
    public function getSessionsProperty(): \Illuminate\Support\Collection
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object) [
                'agent' => $this->createAgent($session),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Render the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('profile.logout-other-browser-sessions-form');
    }

    /**
     * Delete the other browser session records from storage.
     */
    protected function deleteOtherSessionRecords(): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     */
    protected function createAgent($session): \Jenssegers\Agent\Agent
    {
        return tap(new Agent(), function ($agent) use ($session): void {
            $agent->setUserAgent($session->user_agent);
        });
    }
}

<?php

namespace Daguilarm\Belich\App\Http\Livewire;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DataTables extends LivewireDatatable
{
    public function columns()
    {
        $class = Belich::getResource();
    }

    public function render()
    {
        return view('belich::datatables.datatable');
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport($this->getQuery(true)->get()), 'DatatableExport.xlsx');
    }
}

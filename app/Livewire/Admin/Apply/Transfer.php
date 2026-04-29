<?php

namespace App\Livewire\Admin\Apply;

use App\Enums\DegreeTypeEnum;
use App\Models\Degree;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Transfer extends Component
{
    public function render()
    {
        $degrees = Degree::query()
            ->with(['faculties' => function ($query) {
                $query->orderBy('name');
            }])
            ->orderBy('name')
            ->get()
            ->map(function (Degree $degree) {
                return [
                    'id' => $degree->id,
                    'name' => $degree->name,
                    'type' => $this->mapDegreeType($degree->name),
                    'faculties' => $degree->faculties
                        ->map(function ($faculty) {
                            return [
                                'id' => $faculty->id,
                                'name' => $faculty->name,
                            ];
                        })
                        ->values(),
                ];
            })
            ->values();

        return view('livewire.admin.apply.transfer', [
            'degrees' => $degrees,
        ]);
    }

    private function mapDegreeType(string $degreeName): string
    {
        return match ($degreeName) {
            "Bachelor's" => DegreeTypeEnum::BACHELOR->value,
            "Master's" => DegreeTypeEnum::MASTER->value,
            "Master's (Without Thesis)" => DegreeTypeEnum::MASTER_WITHOUT_THESIS->value,
            'PhD' => DegreeTypeEnum::phD->value,
            default => DegreeTypeEnum::BACHELOR->value,
        };
    }
}

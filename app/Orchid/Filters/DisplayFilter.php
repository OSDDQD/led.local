<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use App\Models\Display;

class DisplayFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Экран';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['display_id'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('displays', function (Builder $query) {
            $query->where('id', $this->request->get('display_id'));
        });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('display_id')
                ->fromModel(Display::class, 'title', 'id')
                ->empty()
                ->value($this->request->get('display_id'))
                ->title(__('Выберите экран')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Display::where('id', $this->request->get('display_id'))->first()->title;
    }
}

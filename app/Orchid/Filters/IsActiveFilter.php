<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class IsActiveFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Активность';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['is_active'];
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
        return $builder->where('is_active', $this->request->get('is_active'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('is_active')
                ->options([
                    'Не активные',
                    'Только активные',
                ])
                ->value($this->request->get('is_active'))
                ->empty()
                ->title('Активность'),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        // dd($this->request->get('is_active'), $this->request->get('is_active') ? 'Только активные' : 'Не активные');
        return $this->request->get('is_active') ? 'Только активные' : 'Не активные';
    }
}

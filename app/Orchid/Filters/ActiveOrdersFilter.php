<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class ActiveOrdersFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Статус показа';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['active'];
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
        return $builder->when($this->request->get('active'), function (Builder $query) {
            $query->where('end_at', '>=', now()->format('Y-m-d'));
        })
        ->when(!$this->request->get('active'), function (Builder $query) {
            $query->where('end_at', '<', now()->format('Y-m-d'));
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
            Select::make('active')
                ->options([
                    'Не активные',
                    'Только активные',
                ])
                ->value($this->request->get('active'))
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
        return $this->request->get('active') ? 'Только активные' : 'Не активные';
    }
}

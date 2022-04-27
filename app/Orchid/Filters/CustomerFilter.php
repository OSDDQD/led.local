<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use App\Models\Customer;

class CustomerFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Заказчик';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['customer_id'];
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
        return $builder->where('customer_id', $this->request->get('customer_id'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('customer_id')
                ->fromModel(Customer::class, 'title', 'id')
                ->empty()
                ->value($this->request->get('customer_id'))
                ->title(__('Выберите заказчика')),
        ];
    }
    
    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Customer::where('id', $this->request->get('customer_id'))->first()->title;
    }
}

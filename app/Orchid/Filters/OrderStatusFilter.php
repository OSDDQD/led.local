<?php

namespace App\Orchid\Filters;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class OrderStatusFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return 'Статус заказа';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['status'];
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
        return $builder->where('status', $this->request->get('status'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [
            Select::make('status')
                ->options(Order::STATUS)
                ->value($this->request->get('status'))
                ->empty()
                ->title('Статус заказа'),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        // dd($this->request->get('is_active'), $this->request->get('is_active') ? 'Только активные' : 'Не активные');
        return isset(Order::STATUS[$this->request->get('status')]) ? Order::STATUS[$this->request->get('status')] : '';
    }
}

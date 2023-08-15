<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class EntryRepository
{
    private $table = 'entry_products';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->join('entries', 'entry_products.entry_id', '=', 'entries.id')
            ->join('products', 'entry_products.product_id', '=', 'products.id')
            ->join('cost_center', 'entries.cost_center_id', '=', 'cost_center.id')
            ->select(
                $this->table . '.id AS id',
                $this->table . '.product_id AS productId',
                $this->table . '.entry_id AS entryId',
                $this->table . '.note AS note',
                $this->table . '.note AS note',
                $this->table . '.quantity AS quantity',
                $this->table . '.value AS value',
                'center_cost.id AS centerCostId',
                'center_cost.description AS centerCostDescription',
                'products.description AS productDescription',
                $this->table . '.created_at AS createdAt',
                $this->table . '.updated_at AS updatedAt',
            );
    }

    public function all(string $search = null, string $sortBy = 'id', string $sortDirection = 'asc', string $perPage = '30')
    {
        return $this->baseQuery
            ->where([
                [$this->table . '.id', 'like', '%' . $search . '%'],
            ])
            ->orWhere([
                ['products.description', 'like', '%' . $search . '%'],
            ])
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    public function allSimplified()
    {
        return $this->baseQuery->get();
    }

    public function save($data)
    {
        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'I',
            date('Y-m-d H:i:s'),
            json_encode($data),
            null
        );

        $registerId = DB::table($this->table)
            ->insertGetId(
                [
                    'note' => $data['note'],
                    'user_id' => session()->get('userId'),
                    'created_at' => now(),
                ]
            );

        return $registerId;
    }

    public function update($data)
    {
        $oldData = $this->findById($data['recordId']);

        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'U',
            date('Y-m-d H:i:s'),
            json_encode($oldData),
            json_encode($data)
        );

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->update(
                [
                    'note' => $data['note'],
                    'user_id' => session()->get('userId'),
                    'updated_at' => now(),
                ]
            );
    }

    public function delete($data)
    {
        $oldData = $this->findById($data['recordId']);

        LogService::saveLog(
            session()->get('userId'),
            $this->table,
            'D',
            date('Y-m-d H:i:s'),
            json_encode($oldData),
            null
        );

        DB::table($this->table)
            ->where('id', $data['recordId'])
            ->delete();
    }

    public function findById($id)
    {
        return $this->baseQuery
            ->where($this->table . '.id', $id)
            ->get()
            ->first();
    }
}

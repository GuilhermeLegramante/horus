<?php

namespace App\Repositories;

use App\Services\LogService;
use Illuminate\Support\Facades\DB;

class FakebalanceRepository
{
    private $table = 'fake_balance';

    private $baseQuery;

    public function __construct()
    {
        $this->baseQuery = DB::table($this->table)
            ->select(
                $this->table . '.id AS id',
                $this->table . '.description AS description',
                $this->table . '.previous_balance AS previousBalance',
                $this->table . '.inputs AS entries',
                $this->table . '.outputs AS outputs',
                $this->table . '.current_stock AS currentStock',
                $this->table . '.manual_sales AS manualSales',
                $this->table . '.counter_balance AS counterBalance',
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
                [$this->table . '.description', 'like', '%' . $search . '%'],
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
                    'description' => $data['description'],
                    'previous_balance' => $data['previousBalance'],
                    'inputs' => $data['entries'],
                    'outputs' => $data['outputs'],
                    'current_stock' => $data['currentStock'],
                    'manual_sales' => $data['manualSales'],
                    'counter_balance' => $data['counterBalance'],
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
                    'description' => $data['description'],
                    'previous_balance' => $data['previousBalance'],
                    'inputs' => $data['entries'],
                    'outputs' => $data['outputs'],
                    'current_stock' => $data['currentStock'],
                    'manual_sales' => $data['manualSales'],
                    'counter_balance' => $data['counterBalance'],
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

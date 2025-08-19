<?php

namespace App\Http\Api;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ApiController
{
    protected string $resource;
    protected string $successfullStoreTask;
    protected string $successfullUpdateTask;
    protected string $failedStoreTask;
    protected string $failedUpdateTask;
    protected string $failedDeleteTask;
/*
    protected function listTask(callable $callable): JsonResponse
    {
        return response()->json(
            $callable(),
            
            Response::HTTP_OK
        );
    }*/

    protected function datatableDraw(string $model, array $request, array $columns): JsonResponse
    {
        // Query con paginación
        $query = $model::query();

        // Ejemplo: búsqueda rápida si DataTables manda 'search[value]'
        if (!empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        if(isset($request['columns'])){
            foreach($request['columns'] as $key => $column){
                if(isset($column['search']['fixed'][0]['term'])){
                    $colSearchValue  = $column['search']['fixed'][0]['term'];

                    $query->where($columns[$key], 'like', "%$colSearchValue%");
                }
            }
        }

        $recordsTotal    = $model::count();
        $recordsFiltered = $query->count();
        if(isset($request['order'])){
            $orderDir         = $request['order'][0]['dir'];
            $orderColumnIndex = $request['order'][0]['column'];
            
            if (isset($columns[$orderColumnIndex])) {
                $query->orderBy($columns[$orderColumnIndex], $orderDir);
            }
        }
        
        // Paginación
        $data = $query->skip($request['start'])->take($request['length'] ?? 10)->get();

        return response()->json([
            'draw' => intval($request['draw'] ?? 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $this->resource::collection($data)
        ], Response::HTTP_OK);
    }

    protected function getTask(callable $callable): JsonResponse
    {
        return response()->json(new $this->resource($callable()), Response::HTTP_OK);
    }

    protected function storeTask(callable $callable): JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $callable();
            DB::commit();
            return response()->json([
                'message' => $this->successfullStoreTask,
                'data' => new $this->resource($result)
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();

            if (config('app.debug')) {
                return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['message' => $this->failedStoreTask], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function updateTask(callable $callable): JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $callable();
            DB::commit();
            return response()->json([
                'message' => $this->successfullUpdateTask,
                'data' => new $this->resource($result)
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            if (config('app.debug')) {
                return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['message' => $this->failedUpdateTask], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function deleteTask(callable $callable): JsonResponse
    {
        try {
            DB::beginTransaction();
            $callable();
            DB::commit();
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            DB::rollBack();
            if (config('app.debug')) {
                return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['message' => $this->failedDeleteTask], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

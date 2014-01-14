<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/25/13
 */
namespace App\Model\Resource;

interface IResourceCollection
{
    public function fetch();

    public function filterBy($column, $value);

    public function filterLike($column, $value);

    public function average($column);

    public function limit($limit, $offset = 0);

    public function count();

    public function check($data);
}

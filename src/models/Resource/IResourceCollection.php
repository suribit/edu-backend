<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/25/13
 */

interface IResourceCollection
{
    public function fetch();
    public function filterBy($column, $value);
    public function average($column);
}
 
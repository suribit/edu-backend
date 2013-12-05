<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     12/5/13
 */
namespace App\Model\Resource\Table;
interface ITable
{
    public function getName();

    public function getPrimaryKey();
}
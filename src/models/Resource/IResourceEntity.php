<?php
/**
 * @project  edu-backend
 * @author   Seregei Waribrus <wss.world@gmail.com>
 * @date     11/28/13
 */

namespace App\Model\Resource;

interface IResourceEntity
{
    public function find($id);
}
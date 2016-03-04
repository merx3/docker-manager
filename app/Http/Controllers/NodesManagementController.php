<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Externals\Kubernetes\KubernetesAPI;

class NodesManagementController extends Controller
{
    public function createReplicationController(Request $request)
    {
        return KubernetesAPI::createLocalRC('redis-master-controller.yaml');
    }


    public function createService(Request $request)
    {
        return KubernetesAPI::createLocalService('redis-master-service.yaml');
    }
}

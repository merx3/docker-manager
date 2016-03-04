<?php
/**
 * Created by PhpStorm.
 * User: mnmari
 * Date: 5-2-16
 * Time: 13:46
 */

namespace App\Externals\Kubernetes;


class KubernetesAPI
{
    public static function createLocalRC($yaml_config_name)
    {
        return shell_exec('kubectl create -f k8s_yamls/rc/'.$yaml_config_name);
    }

    public static function createLocalService($yaml_config_name)
    {
        return shell_exec('kubectl create -f k8s_yamls/services/'.$yaml_config_name);
    }
}
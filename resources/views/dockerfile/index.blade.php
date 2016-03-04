<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

    {{--<script type="text/javascript" src="js/dropdown.js"></script>--}}

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 20px;
            width: 100%;
            display: table;
            font-weight: 100;
        }

        .container {
            display: table-cell;
        }

        .content {
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Docker Manager</h1> <br>
        <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#dockerFile_tab" data-toggle="tab">Dockerfile edit</a></li>
            <li><a href="#dockerCompose_tab" data-toggle="tab">Docker Compose</a></li>
            <li><a href="#containersInspection_tab" data-toggle="tab">Container Security</a></li>
            <li><a href="#nodesManagement_tab" data-toggle="tab">Nodes Management</a></li>
            <li><a href="#kubernetesui_tab" data-toggle="tab">Kubernetes UI</a></li>
        </ul>
        <br>

        <div class="tab-content">
            <div class="tab-pane active" id="dockerFile_tab">
                {!! Form::open(['url'=>route('upload_dockerfile'),'method'=>'POST', 'files'=>true]) !!}
                    {!! Form::file('dockerfile') !!}<br/>
                    {!! Form::submit('Parse', array('class'=>'btn btn-primary', 'id'=>'uploadDockerfile')) !!}
                {!! Form::close() !!}

                <h2>Dockerfile content</h2>
                {!! Form::open(['url'=>route('download_dockerfile'),'method'=>'POST']) !!}
                @if(isset($dockerfile))
                        <br>
                    @if(isset($dockerfile->instructions))
                        @foreach($dockerfile->instructions as $instruction)
                            <div class="input-group" style="width: 100%">
                                <label for="datafile-from">{{ $instruction->name }}: </label>
                                <sup><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title=
                                    "The FROM instruction sets the Base Image for subsequent instructions.">
                                        </span>
                                </sup>
                                <input name="arguments" type="text" class="form-control" placeholder="Base image for FROM"
                                    value="{{ $instruction->arguments }}">
                            </div>
                            <br>
                        @endforeach
                    @endif
                @endif
                <div class="btn-group">
                        <div class="dropdown">
                            <button id="addCommand" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                    class="btn btn-primary dropdown-toggle" type="button">Add New Command <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="addCommand">
                                <li><a href="#">ADD</a></li>
                                <li><a href="#">CMD</a></li>
                                <li><a href="#">COPY</a></li>
                                <li><a href="#">ONBUILD</a></li>
                                <li><a href="#">RUN</a></li>
                                <li><a href="#">VOLUME</a></li>
                                <li class="divider" role="separator"></li>
                                <li><a href="#">ARG</a></li>
                                <li><a href="#">ENTRYPOINT</a></li>
                                <li><a href="#">ENV</a></li>
                                <li><a href="#">EXPOSE</a></li>
                                <li><a href="#">STOPSIGNAL</a></li>
                                <li><a href="#">USER</a></li>
                                <li><a href="#">WORKDIR</a></li>
                                <li class="divider" role="separator"></li>
                                <li><a href="#">LABEL</a></li>
                                <li><a href="#">MAINTAINER</a></li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="btn-group">
                        <button id="downloadDockerfile" class="btn btn-primary" type="button">Download
                        </button><br><br>

                        <button id="deployDockerfile" class="btn btn-primary" type="button"
                            onclick="window.open('{{ route("repositories") }}','repositories',
                                    'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350');">
                        Push image to registry</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="dockerCompose_tab">
                TBA: Docker Compose
            </div>
            <div class="tab-pane" id="nodesManagement_tab">
                TBA: Containers management through Kubernetes API: https://github.com/devstub/kubernetes-api-php-client
                <br>
                <h3>Replication Controllers (Grouped Maintained Containers)</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        Redis Master Controller
                    </a>
                </div>
                <h3>Pods (Single containers)</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">-</a>
                </div>
                <br>
                <button id="createContainers" class="btn btn-primary" type="submit"
                        onclick="$.post('{!! route('create_replication_controller') !!}',{},
                function(data) {
                    alert(data);
                });">Create container(s)</button>
                <br><br>
                <h3>Services</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">Redis Master Service</a>
                </div>
                <br>
                <button id="createServices" class="btn btn-primary" type="submit"
                        onclick="$.post('{!! route('create_service') !!}',{},
                                function(data) {
                                alert(data);
                                });">Create container(s)</button>
            </div>
            <div class="tab-pane" id="containersInspection_tab">
                TBA: Inspect security vulnerabilities in containers through
                <a href="https://github.com/docker/docker-bench-security">Docker Bench</a> or
                <a href="https://github.com/coreos/clair">Clair</a>
            </div>
            <div class="tab-pane" id="kubernetesui_tab">
                <iframe src="http://localhost:8080/ui" style="border:none; position: absolute; height: 80%; width: 95%;">
                    Get to <a href="http://localhost:8080/ui">http://localhost:8080/ui</a>
                </iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $('.nav-tabs').tab();
        $('#addCommand').dropdown();
    });
</script>
</body>
</html>

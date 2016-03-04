<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Instruction;
use App\Dockerfile;

class DockerfileParser extends Controller
{
    public function index()
    {
        return view('dockerfile.index');
    }

    public function create(Request $request)
    {
        $file = $request->file('dockerfile');
        if(!$file)
        {
            return 'File missing';
        }
        $fh = fopen($file->getRealPath(), 'r');

        $instructions = [];
        $args_multiline = false;
        while(($line = fgets($fh)) !== false){
            $line = trim($line);
            if(strlen($line) && $line[0] != '#'){
                if(!$args_multiline){
                    $sections = explode(' ', $line, 2);
                    $arguments = rtrim($sections[1], '\\');
                    $instructions[] = [
                        'name' => $sections[0],
                        'arguments' => $arguments
                    ];
                } else {
                    $arguments = rtrim($line, '\\');
                    $instructions[count($instructions) - 1]['arguments'] .= ' '.$arguments;
                }

                if($line[strlen($line) - 1] == '\\'){
                    $args_multiline = true;
                } else {
                    $args_multiline = false;
                }
            }
        }

        $dockerfile = new Dockerfile();
        $dockerfile->dockerfile_id = 1;
        $instruction_number = 1;
        foreach($instructions as $instruction){
            $inst = new Instruction();
            $inst->name = $instruction['name'];
            $inst->instruction_number = $instruction_number++;
            $inst->arguments = $instruction['arguments'];
            $dockerfile->instructions->add($inst);
        }

        return view('dockerfile.index')->with('dockerfile', $dockerfile);
    }

    public function download()
    {

    }
}


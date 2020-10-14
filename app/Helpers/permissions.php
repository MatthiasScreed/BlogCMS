<?php

function check_user_permissions($request, $actionName = NULL, $id = NULL)
{
    // get current user
    $currentUser = $request->user();

    // current action name
    if($actionName) {
        $currentActionName = $actionName;
    }else{

        $currentActionName = $request->route()->getActionName();
    }
    list($controller, $method) = explode('@', $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

    $crudPermissionsMap = [
        // 'create' => ['create', 'store'],
        // 'update' => ['edit', 'update'],
        // 'delete' => ['destroy', 'store', 'forceDestroy'],
        // 'read' => ['index', 'view']

        'crud' => ['create', 'store', 'edit', 'update', 'destroy', 'restore', 'forceDestroy', 'index', 'view']
    ];

    $classesMap = [
        'Blog' => 'post',
        'Categories' => 'category',
        'Users' => 'user'
    ];

    foreach($crudPermissionsMap as $permission => $methods)
    {
        // if the current method exists in methods list,
        // we'll check the permission
        if (in_array($method, $methods) && isset($classesMap[$controller]))
        {
            $classesName = $classesMap[$controller];

            if($classesName == 'post' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'forceDestroy'])){

                $id = !is_null($id) ? $id : $request->route('blog');
                //if the current user has not update-others-post/delete-others-post permission
                //make sure he/she only modify his/her own post
                if( $id && !$currentUser->isAbleTo('update-others-post') || !$currentUser->isAbleTo('delete-others-post'))
                {
                    $post = \App\Post::withTrashed()->find($id);
                    if($post->author_id !== $currentUser->id) {
                        return false;
                    }
                }
            }
            // if the user has not permission don't allow next request
            elseif(! $currentUser->isAbleTo("{$permission}-{$classesName}")) {
                return false;
            }
            break;
        }
    }
    return true;
}

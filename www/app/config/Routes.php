<?php

class Routes
{
    public function createRouter()
    {
        $router = new Router();
        $router
                // Front end
                ->addRoute('/kurz1/day-{id}-ex-{exId}',         'c1:Course:showDayAndEx')
                ->addRoute('/kurz1/day-{id}',                   'c1:Course:showDay')
                ->addRoute('/kurz1/cvik-{id}',                  'c1:Course:showExercise')
                ->addRoute('/kurz1/splnitden-{id}',             'c1:Course:completeDay')
                ->addRoute('/kurz1/nesplnitden-{id}',           'c1:Course:uncompleteDay')
                ->addRoute('/kurz1',                            'c1:Course:showAllDays')
                
                // Admin
                ->addRoute('/kurz1/admin',                      'c1:admin:AdminCourse:default')
                ->addRoute('/kurz1/admin/den/info-{id}',        'c1:admin:AdminDay:showDay')
                ->addRoute('/kurz1/admin/den/pridat',           'c1:admin:AdminDay:showAdd')
                ->addRoute('/kurz1/admin/den/pridatakce',       'c1:admin:AdminDay:add')
                ->addRoute('/kurz1/admin/den/smazat-{id}',      'c1:admin:AdminDay:delete')
                ->addRoute('/kurz1/admin/den/upravitakce-{id}', 'c1:admin:AdminDay:edit')
                ->addRoute('/kurz1/admin/den/upravit-{id}',     'c1:admin:AdminDay:editShow')
                
                ->addRoute('/kurz1/admin/cvik/info-{id}',       'c1:admin:AdminExercise:show')
                ->addRoute('/kurz1/admin/cvik/upravitakce-{id}','c1:admin:AdminExercise:edit')
                ->addRoute('/kurz1/admin/cvik/upravit-{id}',    'c1:admin:AdminExercise:editShow')
                ->addRoute('/kurz1/admin/cvik/novyakce',        'c1:admin:AdminExercise:add')
                ->addRoute('/kurz1/admin/cvik/novy-{dayId}',    'c1:admin:AdminExercise:showAdd')
                ->addRoute('/kurz1/admin/cvik/smazat-{id}',     'c1:admin:AdminExercise:delete')
                ->addRoute('/kurz1/admin/cvik',                 'c1:admin:AdminExercise:showAll')
                
                
                ->addRoute('/',                             'common:Default:default');
        
        return $router;
    }
}


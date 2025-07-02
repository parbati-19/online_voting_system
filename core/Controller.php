<?php 
 class Controller{
        
    /**
     * loads the dynamic model $model
     * @param string $model         specify model
     * @return object               returns object of that model
     * @throws Exception            throws exception if the model isnot foungf
     */
     public function model($model){
        $modelName = ucfirst($model);
        
        $modelPath = 'app/Models/'.$modelName.'.php';
        if(file_exists($modelPath)){
            
            require_once $modelPath; 
                      
            if(class_exists($modelName)){
                return new $modelName;
            }else{
                throw new Exception("Model name '$modelName' not found!");
            }
            
        }else{
                throw new Exception("Model Path '$modelPath' not found!");
            }
     }

     /**
      * loads the view file & extract data in array and pass it to the view file 
      * @param string $view
      * @param array $data
      */
      
    public function view($view, $data=[]){
        
        extract($data);

        $viewPath = 'app/Views/' . $view .'.php';
        
        if(file_exists($viewPath)){
            require_once $viewPath;
        }else{
            echo "View file '$viewPath' not found!";
        }
        
      }
}
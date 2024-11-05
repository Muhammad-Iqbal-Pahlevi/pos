<?php

require_once __DIR__ . "/model.php";


class Menu extends Model{

    protected $table = "items";


       public function create($datas){
         // var_dump($datas["post"]);
         // var_dump($datas["files"]);

         $namaFile = $datas['files']['attachment']['name'];
         $tmp_name = $datas['files']['attachment']['tmp_name'];
         $ekstensi_file = pathinfo($namaFile, PATHINFO_EXTENSION);
         $ekstensi_allowed = ['jpg', 'png', 'jpeg', 'gif', 'raw'];
         if(!in_array($ekstensi_file, $ekstensi_allowed)){
            return "Ekstensi file tidak diijinkan";
         }

         if($datas['files']['attachment']['size'] > 5000000) {
            return "Ukuran file harus kurang dari 5MB";
         }

         $namaFile = random_int(1000, 9999) . "." . $ekstensi_file;
         echo "haloo";
         move_uploaded_file($tmp_name, "../public/img/items/" . $namaFile);   
         $datas = [
            "name" => $datas["post"]["name"],
            "attachment" => $namaFile,
            "price" => $datas["post"]["price"],
            "category_id" => $datas["post"]["category_id"]
         ];
         return parent::create_data($datas, $this->table);
       }

       public function all(){
          return parent::all_data($this->table);
       } 


       public function find($id){
          return parent::find_data($id, $this->table);
       }

       public function update($id, $datas){
          return parent::update_data($id, $datas, $this->table);
       }

       public function delete($id){
          return parent::delete_data($id, $this->table);
       }

       public function search($keyword, $start = null, $limit = null)
       {
         $queryLimit = '';
         if(isset($start) && isset($limit)){
            $queryLimit = " LIMIT $start, $limit";
         }
         $keyword = " WHERE name LIKE '%{$keyword}%' $queryLimit";
         return parent::search_data($keyword, $this->table);
       }

       public function paginate($start, $limit){
        return parent::paginate_data($this->table, $start, $limit);
       }    
}
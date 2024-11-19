<?php

require_once __DIR__ . "/model.php";


class Menu extends Model{

    protected $table = "items";
    protected $primaryKey = "id_item";


       public function create($datas){
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
         move_uploaded_file($tmp_name, "../public/img/items/" . $namaFile);   
         $datas = [
            "name_item" => $datas["post"]["name_item"],
            "attachment" => $namaFile,
            "price" => $datas["post"]["price"],
            "category_id" => $datas["post"]["category_id"]
         ];
         var_dump($datas);
         return parent::create_data($datas, $this->table);
       }

       public function all(){
          return parent::all_data($this->table);
       } 


       public function find($id){
          return parent::find_data($id, $this->primaryKey, $this->table);
       }

       public function update($id, $datas){
         $attachment = '';
         if($datas['files']['attachment']['name'] !== ''){
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
            move_uploaded_file($tmp_name, "../public/img/items/" . $namaFile);
            $attachment = $namaFile;
         };
         $datas = [
            "name_item" => $datas["post"]["name_item"],
            "price" => $datas["post"]["price"],
            "category_id" => $datas["post"]["category_id"]
         ]; 
         if($attachment !== '') {
            $datas["attachment"] = $attachment;
         }
         return parent::update_data($id, $this->primaryKey, $datas, $this->table);
      }

       public function delete($id){
          return parent::delete_data($id, $this->primaryKey, $this->table);
       }

       public function search($keyword, $start = null, $limit = null)
       {
         $queryLimit = '';
         if(isset($start) && isset($limit)){
            $queryLimit = " LIMIT $start, $limit";
         }
         $keyword = " WHERE name_item LIKE '%{$keyword}%' $queryLimit";
         return parent::search_data($keyword, $this->table);
       }

/*************  ✨ Codeium Command ⭐  *************/
       /**
        * This function is used to paginate data from items table
        * It takes 2 parameters, $start and $limit
/******  2727ec97-3c60-4d28-80bf-e03c75d25ad0  *******/
       public function paginate($start, $limit){
        return parent::paginate_data($this->table, $start, $limit);
       }    

       public function all_2($start, $limit){
         $query = "SELECT * FROM items JOIN categories ON items.category_id = categories.id_category LIMIT $start, $limit";
         $result = mysqli_query($this->db, $query);
         return $this->convert_data($result);
       }
}
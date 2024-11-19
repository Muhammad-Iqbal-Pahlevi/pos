<?php


require_once __DIR__ . "/model.php";


class Users extends Model
{

   protected $table = "users";
   protected $primaryKey = "id_users";

   public function create($datas)
   {
      return parent::create_data($datas, $this->table);
   }

   public function all()
   {
      return parent::all_data($this->table);
   }



   public function find($id)
   {
      return parent::find_data($id, $this->primaryKey, $this->table);
   }

   public function update($id, $datas)
   {
      return parent::update_data($id, $this->primaryKey, $datas, $this->table);
   }

   public function delete($id)
   {
      return parent::delete_data($id, $this->primaryKey, $this->table);
   }

   public function register($datas)
   {
      $name = $datas['post']["full_name"];
      $gender = $datas['post']['gender'];
      $email = $datas['post']['email'];
      $password = $datas['post']['password'];

      $query = "SELECT * FROM {$this->table} WHERE email = '$email'";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) > 0) {
         return "Email already exists";
      }

      $namaFile = $datas['files']['avatar']["full_name"];
      $tmp_name = $datas['files']['avatar']['tmp_name'];
      $ekstensi_file = pathinfo($namaFile, PATHINFO_EXTENSION);
      $ekstensi_allowed = ['jpg', 'png', 'jpeg', 'gif', 'raw'];
      if (!in_array($ekstensi_file, $ekstensi_allowed)) {
         return "Ekstensi file tidak diijinkan";
      }

      if ($datas['files']['avatar']['size'] > 5000000) {
         return "Ukuran file harus kurang dari 5MB";
      }

      $namaFile = random_int(1000, 9999) . "." . $ekstensi_file;
      move_uploaded_file($tmp_name, "../public/img/users/" . $namaFile);

     

      $password = base64_encode($password);
      $query_register = "INSERT INTO {$this->table}  (nama, avatar, gender, email, password) VALUES ('$name',  '$namaFile', '$gender', '$email', '$password')";
      $result = mysqli_query($this->db, $query_register);
      $user = mysqli_fetch_assoc($result);
      $_SESSION["id_users"] = $user["id_users"];
      $_SESSION["full_name"] = $name;
      $_SESSION['password'] = $password;
      $_SESSION['avatar'] = $namaFile;

      $detail_user = [
         'id_users' => $user["id_users"],
         "full_name" => $name,
         'email' => $email,
         'avatar' => $namaFile
      ];

      return $detail_user;     
   }

   public function login($email, $password)
   {

      $query = "SELECT * FROM ($this->table) WHERE email = '$email'";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) == 0) {
         return "User not found";
      }

      $user = mysqli_fetch_assoc($result);
      if (base64_decode($user['password'], false) == $password) {
         $_SESSION["id_users"] = $user["id_users"];
         $_SESSION["full_name"] = $user["full_name"];
         $_SESSION['email'] = $user['email'];
         $_SESSION['avatar'] = $user['avatar'];
   
         return $user = [
            "full_name" => $user["full_name"],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'id_users' => $user['id_users']
         ];
   
         return $user;
      }else{
         return "Wrong password";
      }
   }

   public  function updatePassword($id, $oldPassword, $newPassword)
   {
      $query = "SELECT * FROM $this->table WHERE id_users = $id";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) == 0) {
         return "User not found";
      }

      $user = mysqli_fetch_assoc($result);
      if (base64_decode($user['password'], false) !== $oldPassword) {
         return "Wrong password";
      }

      $newPassword = base64_encode($newPassword);
      $query_update = "UPDATE $this->table SET password = '$newPassword' WHERE id_users = $id";
      $resultUpdate = mysqli_query($this->db, $query_update);
      if ($resultUpdate == false) {
         return "Failed to update password";
      }
      return [
         "full_name" => $user["full_name"],
         'email' => $user['email'],
         'id_users' => $user['id_users']
      ];
   }

   public function logout()
   {
      session_destroy();
      return 'Logout success';
   }
}

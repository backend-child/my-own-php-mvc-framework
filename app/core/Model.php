<?php

trait Model
{
    use Database;


    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";


    // Find all saved data in the database

    public function findAll()
    {

        $query = "";
        $query .= " SELECT * FROM $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return  $this->query($query);
    }

    public function second($data, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        // for each for the keys 
        foreach ($keys as $key) {
            # code...
            $query .= $key . " = :" . $key . " && ";
        }

        //for each for the not-keys
        foreach ($keys_not as $key) {
            # code...
            $query .= $key . " != : " . $key . "&&";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }


    public function where($data, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        // for each for the keys 
        foreach ($keys as $key) {
            # code...
            $query .= $key . " = :" . $key . " && ";
        }

        //for each for the not-keys
        foreach ($keys_not as $key) {
            # code...
            $query .= $key . " != : " . $key . "&&";
        }

        $query = trim($query, " && ");

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        return  $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        // for each for the keys 
        foreach ($keys as $key) {
            # code...
            $query .= $key . " = :" . $key . " && ";
        }

        //for each for the not-keys
        foreach ($keys_not as $key) {
            # code...
            $query .= $key . " != : " . $key . "&&";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        $result =  $this->query($query, $data);

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }


    public function insert($data)

    {

        // to remove unwanted data

        if (!empty($this->allowedColumns)) {

            foreach ($data  as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = ":" . implode(",:", $keys);
        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        $this->query($query, $data);

        return false;
    }



    public function update($id, $data, $id_column = 'id')
    {
        // to remove unwanted data

        if (!empty($this->allowedColumns)) {

            foreach ($data  as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET  ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " , ";
        }

        $query = trim($query, " , ");
        $query .= " WHERE $id_column = :$id_column ";

        $data[$id_column] = $id;

        $this->query($query, $data);

        return false;
    }



    public function delete($id, $id_column = 'id')
    {

        $data[$id_column] = $id;

        $query = " DELETE  FROM $this->table WHERE $id_column = :$id_column  ";


        $this->query($query, $data);

        return false;
    }
}

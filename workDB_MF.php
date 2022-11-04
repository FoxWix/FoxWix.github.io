<?php
    //
    //  DBへ接続
    //
    function connectDB(){

        //設定ファイルの読み込み
        $file = fopen("workDB_MF.ini", "r");
        if($file){
            $row = 1;
            while($line = fgets($file)){
                switch($row){
                    case 5:
                        //ユーザ名の取得
                        $user = trim(substr($line,  7));
                        break;
                    case 7:
                        //パスワードの取得
                        $password = trim(substr($line,  11));
                        break;
                    case 9:
                        //データーベース名の取得
                        $dbname = trim(substr($line,  9));
                        break;
                    case 11:
                        //ホストの取得
                        $host = trim(substr($line,  7));
                        break;
                    case 13:
                        //文字コードを取得
                        $charset = trim(substr($line,  10));
                        break;
                }
                $row++;
            }
        }
        fclose($file);

        //接続文字列を作成
        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
        
        try{

            $pdo = new PDO($dsn, $user, $password);
            $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $pdo;

        }catch(Exception $e){

            echo $e -> getMessage();
            
            $pdo = NULL;

        }
    }

    //
    //  任意のSQL文を実行
    //
    function FreeWordSQL($sql){
        try{

            $pdo = connectDB();

            $stm = $pdo -> prepare($sql);
            $stm -> execute();

            //返却値がある場合は返却
            $value = $stm -> fetchAll(PDO::FETCH_ASSOC);
            if(isset($value)){
                return $value;
            }

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  指定されたテーブルの全件取得
    //
    function GetData_ALL($tablename){
        try{
            
            $pdo = connectDB();

            $sql = "SELECT * FROM {$tablename};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();

            $value = $stm -> fetchAll(PDO::FETCH_ASSOC);
            return $value;

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    // テーブル名とIDで指定されたデータを取得
    //
    function GetData_SELECT($tablename, $tableid, $id){
        try{

            $pdo = connectDB();

            $sql = "SELECT * FROM {$tablename} WHERE {$tableid}={$id};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();

            $value = $stm -> fetchAll(PDO::FETCH_ASSOC);
            return $value;

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  指定されたテーブルへ引数のデータを登録
    //
    function Add($tablename, $data){
        try{

            //DBへ接続
            $pdo = connectDB();
            
            //指定されたテーブルのカラム名を取得
            $col = CreateSQLColumn($tablename);

            //登録データの抽出
            $value = CreateSQLValue($data);

            //登録の実行
            $sql = "INSERT INTO {$tablename} ({$col}) VALUES ({$value});";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();

        }catch(Exception $e){
            return $e;
            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  二つのテーブルへ登録作業を行う
    //
    function AddTransaction($tablename1, $tablename2, $data1, $data2){
        try{

            $pdo = connectDB();
            //トランザクションの開始
            $pdo -> beginTransaction();

            //指定されたテーブルのカラム名を取得
            $col1 = CreateSQLColumn($tablename1);
            $col2 = CreateSQLColumn($tablename2);

            //登録データの抽出
            $value1 = CreateSQLValue($data1);
            $value2 = CreateSQLValue($data2);

            //登録の実行
            $sql = "INSERT INTO {$tablename1} ({$col1}) VALUES ({$value1});";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();
            $sql = "INSERT INTO {$tablename2} ({$col2}) VALUES ({$value2});";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();
            
        }catch(Exception $e){

            //エラーが発生した場合はロールバック
            $pdo -> rollBack();

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  指定されたテーブルのカラム名を取得し、SQL文のパーツを作成する
    //
    function CreateSQLColumn($tablename){
        try{
            $pdo = connectDB();

            //テーブルのカラム名を取得
            $sql = "show columns from {$tablename};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();
            $colmuns = $stm -> fetchAll(PDO::FETCH_ASSOC);

            //取得したカラム名をSQL文用に加工
            $col = "";
            $pk = true;
            foreach($colmuns  as $colmun){

                //      <<<   PKが連番設定ではない場合は削除    >>>
                /*
                if($pk) {
                    $pk = false;
                    continue;
                }
                */

                $col .= $colmun['Field'] . ",";
            }
            $end = strlen($col) - 1;
            $col = substr($col, 0, $end);

            return $col;

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  指定された値から、SQL文のパーツを作成する
    //
    function CreateSQLValue($data){
        try{

            $value = "";
            foreach($data as $d){
                
                //値が文字列の場合は先頭と末尾に「’」をつける
                if(gettype($d) == "string"){
                    $value .= "'" . $d . "',";
                    continue;
                }
                $value .= (string)$d . ",";
            }
            $end = strlen($value) - 1;
            $value = substr($value, 0, $end);

            return $value;
            
        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

    //
    //  テーブル名とIDで指定されたデータを削除
    //
    function DeleteItem($tablename, $tableid, $id){
        try{

            $pdo = connectDB();

            $sql = "DELETE FROM {$tablename} WHERE {$tableid}={$id};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();

            return true;

        }catch(Exception $e){

            echo $e -> getMessage();

            return false;

        }finally{

            $pdo = NULL;

        }
    }







    //  ↓↓↓↓↓↓↓　新しく作った処理　↓↓↓↓↓↓↓

    //
    //  データの存在確認
    //
    function data_exists($tablename, $colmunname, $data){
        try{
        $pdo = connectDB();
        $data = CreateSQLValue($data);

        $sql = "SELECT * FROM  {$tablename} WHERE {$colmunname}={$data}";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) > 0){
            return true;
        }
        else{
            return false;
        }

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }


    //
    //  指定されたテーブルへ引数のデータを登録（自動採番）
    //
    function Add_AUTO_INCREMENT($tablename, $data){
        try{

            //DBへ接続
            $pdo = connectDB();
            
            //指定されたテーブルのカラム名を取得
            $col = CreateSQLColumn_AUTO_INCREMENT($tablename);

            //登録データの抽出
            $value = CreateSQLValue($data);

            //登録の実行
            $sql = "INSERT INTO {$tablename} ({$col}) VALUES ({$value});";

            $stm = $pdo -> prepare($sql);
            $stm -> execute();

        }catch(Exception $e){

            echo $e;
            return $e;
            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }


    //
    //  指定されたテーブルのカラム名を取得し、SQL文のパーツを作成する(自動採番)
    //
    function CreateSQLColumn_AUTO_INCREMENT($tablename){
        try{
            $pdo = connectDB();

            //テーブルのカラム名を取得
            $sql = "show columns from {$tablename};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();
            $colmuns = $stm -> fetchAll(PDO::FETCH_ASSOC);

            //取得したカラム名をSQL文用に加工
            $col = "";
            $pk = true;
            foreach($colmuns  as $colmun){

                //      <<<   PKが連番設定ではない場合は削除    >>>
                
                if($pk) {
                    $pk = false;
                    continue;
                }
                
                
                $col .= $colmun['Field'] . ",";
            }
            $end = strlen($col) - 1;
            $col = substr($col, 0, $end);

            return $col;

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }


    //
    // テーブル内で最大のID + 1 のID取得
    //
    function GetData_Increment_MaxID($tablename,$tableid){
        try{

            $pdo = connectDB();

            $sql = "SELECT LPAD((MAX(CAST(SUBSTRING($tableid ,2 ,4) as SIGNED)) + 1) ,4 ,0) as $tableid FROM {$tablename};";
            $stm = $pdo -> prepare($sql);
            $stm -> execute();

            $value = $stm -> fetchAll(PDO::FETCH_ASSOC);
            return $value;

        }catch(Exception $e){

            echo $e -> getMessage();

        }finally{

            $pdo = NULL;

        }
    }

        //
    // テーブル名、項目名とID、PWで指定されたデータを取得(ログイン処理)
    //
    function GetData_LOGIN($tablename, $colmunname, $id, $pw){
        try{

            $pdo = connectDB();

            $id = CreateSQLValue($id);
            $pw = CreateSQLValue($pw);

            $sql = "SELECT * FROM {$tablename} WHERE {$colmunname[0]}={$id} AND {$colmunname[1]}={$pw};";
            $stm = $pdo -> prepare($sql);
            
            $stm -> execute();

            $value = $stm -> fetchAll(PDO::FETCH_ASSOC);
            return $value;

        }catch(Exception $e){
            $e -> getMessage();

        }finally{
            $pdo = NULL;

        }
    }



?>
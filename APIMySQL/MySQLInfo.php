<?php
////////////////////////
//制作者　名越大樹
//クラス名　mysqlの情報に関するクラス
////////////////////////

class MySQLInfo
{
    ////////////////////////////////
    //メンバー変数宣言開始
    ////////////////////////////////
    private $passWord = "";//mysqlのパスワードの値
    private $rootName = "";//mysqlのログイン時の名前の値
    private $dataBaseName = "";//接続するデータベースの値
    private $hostName = "";//接続先の値
    private $tableName = "";//mysqlのテーブルの名前の値
    ////////////////////////////////
    //メンバー変数宣言終了
    ////////////////////////////////

    ///////////////////////////////////
    //ゲッター処理
    ///////////////////////////////////
    //返り値string型
    public function GetRoot()
    {
      return $this->rootName;
    }

    //返り値string型
    public function GetPassWord()
    {
      return $this->passWord;
    }

    //返り値string型
    public function GetHostName()
    {
      return $this->hostName;
    }

    //返り値string型
    public function GetDataBase()
    {
      return $this->dataBaseName;
    }

    //返り値string型
    public function GetTableName()
    {
      return $this->tableName;
    }
    ///////////////////////////////////
    //ゲッター処理終了
    ///////////////////////////////////

    ///////////////////////////////////
    //セッター処理
    ///////////////////////////////////
    //$set = string型の変数をセット
    public function SetRoot($set)
    {
      $this->rootName = $set;
    }

    //$set = string型の変数をセット
    public function SetPassWord($set)
    {
      $this->passWord = $set;
    }

    //$set = string型の変数をセット
    public function SetHost($set)
    {
      $this->hostName = $set;
    }

    //$set = string型の変数をセット
    public function SetDataBase($set)
    {
      $this->dataBaseName = $set;
    }

    //$set = string型の変数をセット
    public function SetTableName($set)
    {
      $this->tableName = $set;
    }
    //////////////////////////////////
    //セッター処理終了
    //////////////////////////////////
}
?>

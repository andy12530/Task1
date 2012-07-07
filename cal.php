<?php
/*
apache服务器需要开启URL重写
将cal.php与此无.htaccess放在主机根目录即可运行
*/
//非递归式阶乘
function factorial($num){
    $temp = 1;
    for($i = 2; $i <= $num; $i++ ){
        $temp = $temp * $i;
    }
    return $temp;
}
//非递归式菲波那契数列
function fibonacci($num){
    $temp1 =1;
    $temp2=1;
    if($num <= 2){
        return 1;
    } else{
        for($i = 3; $i<= $num; $i++){
            $temp = $temp1 + $temp2;
            $temp2 = $temp1;
            $temp1 = $temp;
        }
    }
    return $temp; 
}

$result = 1;
$calType = $_GET['type'];
if($calType == "404"){ //错误的格式处理
    echo "Wrong Format !";
    exit;
}
$num1 = $_GET['num1'];
if(isset($_GET['num2'])){
    $num2 = $_GET['num2'];
}

if(is_numeric($num1)){ //处理数字1
    $num1 = (float)$num1;
} else{
    echo json_encode("Invalid input a");
    exit;
}

if($calType == "mult"){
    if(is_numeric($num2)){//处理数字2
        $num2 = (float)$num2;
    } else{
        echo json_encode("Invalid input b");
        exit;
    }
    $result =  $num1 * $num2;
} else if($calType == "square"){
    $num1 = (String)$num1;//转换数字为字符串
    $result =  $num1 * $num1;
} else if($calType == "factorial"){
    $num1 = (String)abs(round((int)$num1));//处理数字1为int，且为正值

    $result = factorial($num1);
} else if($calType == "fibonacci"){
    $num1 = (String)abs(round((int)$num1));
    
    $result = fibonacci($num1);
} else{
    echo "The Cal Type Invalid";
    exit;
}

//构建json数组
if($calType == "mult"){
    $json = array("a"=>$num1, "b"=>$num2, "result"=>$result);
} else{
    $json = array("n"=>$num1, "result"=>$result);
}
//输出json
echo json_encode($json);
?>
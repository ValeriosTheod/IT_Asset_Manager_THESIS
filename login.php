<?php
$ch = curl_init();

if ($_POST['username'] && $_POST['password']) {

    $username =  $_POST['username'];
    $password =  $_POST['password'];

    curl_setopt($ch, CURLOPT_URL, 'https://sso.aegean.gr/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$username&password=$password&execution=15742aab-f650-4140-8e35-14b8e73ada30_ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0lzSW10cFpDSTZJakU1WXpVMU1qRTJMVGRqTURBdE5HTmxZeTA0TXpJd0xUUXhZV1UzTlRka016RXlOaUo5LkJ4bUk1YTRnV01waFY5ZndxWkhPbHV2bFpLWDNlajB2eXFhSklKR2prYW5aQVFzQkVJQ1puVGFkbXI4MlVCWWNsT0lzVUEzelJGV1c5NGt1OHJ6ZWx6S1FNQ3JZelN3d2M3bk1meWl4bkRZenNfNkFvODVGVUdtWnhPdGpONjEzdWstZkE3b1FxQnRvNEFtZGFyN0gtNGZkclpreFgxNV9NMXNmN2dJYmpId3Mwc1VHekxzT2VQTVVEM0JFOF9pcy0tbFp3LXNTeDFVYkJKZF9iU3Z5bGhrLVNRaGI2eDVEOTV1UGNvQTJSOVZ4bTN1TmtoMHRXMXVQYUxrNFNzT3J3OHNHX3hhM2tESjlnMFpFeVpDZV9DZW1wakhTTW5RQjQtblZLY01uZUkyTElWeDRZRzRNSDc5NjNGRkE2MzQ4RUVWWV9zNzVwWkQ1RnRHZlFUNGFMQkhxVFdxZzdHVm9wYkxTTlNHZng2RkFlM1RCTWlzQXdCUjhXbWJwM21adnI1c2l4X0lQM040d1l6WkxaQWpHeVp5OWJxWEJ3WVluUTlqb2ZEUEQwS21DdXR3OEtwWUZUbHRSd1VVdkh2V19FNENpSG5SbzFrUmltaUdRVVczeTBvdDFQQ0d6QkoyQ0ZQdHgwNlU3ZF9CZ3g5dm1FZ1hjbDR3bExjbXNEbFFYQmVqUDZJUlluVDQ2aVBuc25tTEM5dHhzUFRNcE96M05tczdUcVpNd29SMzV6S2ltc2pjOHlPSDJQb3BIMnUyYlpPbF9JSjhVVVpQSjFpMWFLVEdrYnZJRWp5MWlPcmxHaHhwNjM2SXYyTm4yTXBidXlNUmxrb3NGRHFtRWk2Z2lPTE1SbGxGNDEtUDl4Z2RJSk51MWpCbkJqNzFRdExyQ1ZXZkJHWTJ3OUZXWVo1LThEck8wTFNIbDNMWXByODB1TUZnbzZzRUs5dWo4Z3dnSHExSUphT2tLbUNSRVBZWl9obWpMdFZpVDExMGdZQlpSUnZYbnliZ2ZYeXBRRTU2WGgwUGZtbWtmdTFTVXo1ckMydVNMdTJnR09DYkd2TTdUdmRsX3pieHhZVEo0aE9nNmMzb2xYekh0SjZOU01BbGpPVHVHY3FOQ2lpb0FXdmpXakY0LXpZeXhkS2hJbDVIWWFWNVVsT3A3WXZjTHctNmJ3b1BxdVFGUXJvbHBPcHZlU2UwejU0dkQyaHk3VDByUW9ZdEpHSzIyVkg4MmtLd0tuVlpDaG1EZWhfLTUzMlVocHhTNWp5Y1hJUnBlOW1RLWhKWUlTLXVNTExEUkNUM19Ca09KS0xpMVpGRjg5cENNa2c1RGNCZGtMdWFsZGRZcjlraFJ4YkNvaTgyQmJTYnFwbkg0T0FvWk1oNnRoeWVTOFlTLVp5Tl92WHZZX1U2Nk9kTmFMRFJKSFNLdU5TNmVjcTdxczNic1Z1LXNFM1E5RWtfOXktaVROQXRnMXQzcDMzZHRlMHNhWjJsU1lnSm4ud1dabGI0VVBIcWQ3d2ZFcVl5aHpVVlVvTGxYR1UyWUlrTHI1cnoyN1FWZ0FCcHVrOWczdXhqTWJadldjR0FVR2pEbDF2MlMwUWp6RU1Ob0wwNUZmd3c%3D&_eventId=submit&geolocation=");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7';
    $headers[] = 'Accept-Language: el-GR,el;q=0.9,en;q=0.8,tr;q=0.7,da;q=0.6';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Cookie: org.springframework.web.servlet.i18n.CookieLocaleResolver.LOCALE=el-GR';
    $headers[] = 'Origin: https://sso.aegean.gr';
    $headers[] = 'Referer: https://sso.aegean.gr/login';
    $headers[] = 'Sec-Fetch-Dest: document';
    $headers[] = 'Sec-Fetch-Mode: navigate';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-User: ?1';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36';
    $headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"116\", \"Not)A;Brand\";v=\"24\", \"Google Chrome\";v=\"116\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: \"macOS\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    //echo $result;
    if (str_contains($result, 'Επιτυχής Σύνδεση')) {
      session_start();
      $_SESSION["username"] = $username;
      echo "true";
    }
    else echo "false";
    curl_close($ch);
}
else echo "false";

// $cmd="curl 'https://sso.aegean.gr/login' \
//   -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
//   -H 'Accept-Language: el-GR,el;q=0.9,en;q=0.8' \
//   -H 'Cache-Control: max-age=0' \
//   -H 'Connection: keep-alive' \
//   -H 'Content-Type: application/x-www-form-urlencoded' \
//   -H 'Cookie: JSESSIONID=0AC82DA609FDF54C22F848F69E320EC9' \
//   -H 'Origin: https://sso.aegean.gr' \
//   -H 'Referer: https://sso.aegean.gr/login' \
//   -H 'Sec-Fetch-Dest: document' \
//   -H 'Sec-Fetch-Mode: navigate' \
//   -H 'Sec-Fetch-Site: same-origin' \
//   -H 'Sec-Fetch-User: ?1' \
//   -H 'Upgrade-Insecure-Requests: 1' \
//   -H 'sec-ch-ua-mobile: ?1' \
//   --data-raw 'username=icsd13191&password=J*5rdvgp3&execution=a7fc9ca8-54bc-4eaa-951e-5cfefef7c488_ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LkJ4bUk1YTRnV01waFY5ZndKNUhKbnV2bEhpRi1YWFVvdzhBaWxuelhxMGp3VmV1WTMzbzNJWVRHUmtIY0lhV0hZcU1jR19uNlF0T25RN2ZCRGp6cTNBaENQMERQektIWWJZakx4LWhDbmFtODNpTFVrdkhoWnJGdWJUUkNUVkhHRkNXdGwyaUlub3NlZnFaVWNGWjFOQlU0RUU1dURtQy11V0lVd2hsbld1WVJEeWtzekMwejV6QmZBSlZ2aHJXeFI3TUpYMWhoTHVmZXgzdkhFMERqbHlJOGdmSnVnMGNucVBuWVJ2eEFsYkctX1N3X2NiRGU0czh5andITGdfTHFNc3RWaTNnYzBiWnoxOFFMS2ZOQkRPWUR0Z3lnWFJFMHZaS0Z0b2hjRU9yamJ2cU9Oa0V2SmE1Z1FOSGx1cFd4SnB2cjB6YTFpV1N6TC14M2g5cGl0U00tWnVEb0VwU09UaU9CMnk5bTI3X3ZyVkczT1poNWZPZFc0NVZmMVliVDM3Skg2T25Kb0hhdXVCU2NwU245czU1aG03SjRVQmhRMEZ1RGZ1bXJMZEppNnFReDZONGpYTWJ3YzNNakRnaXZiNnhTT1JOdHllblBZU2tzZ3FLNWgzdFFtVEZKcVVsRmxOcU1WckNldldPaEdiU2dsS05qT084a0ZGa29MMFY5eGR4aVFBd1NiV1BsYmxUdzFvUGVIZHJoUkNDV3JlcmhqdXJqX0ljYk45cFdzczc5czVSbzRRdERNNDhnVm1LbDlKdVZ5XzRXRzBKY003QWJIbFZTNEVBYlZ5STRPTm84aFJuZG5QZTgwMGRhUU1DbjJIREVSWERfZTJHcGRmd2RrVTQ2OU5UQTdUZ1VISm1jQjN5UmxZbGJKelJTOVdFM1k1Q2tNZlhqNDJtbnNfRi1FbDhjaWtWN0packxESGh2dVlmdWFPdnhJR3JIZkhXX3lXYjktbXBEZlBveGszN2JHUnltaTRIRHNjcElDODk4UFFhemt1STRaTlQtdTM5a0tQMFhNVEtwWXZzV1pNak9zaXR5NnppVEo3am41a2NUR0ZiUnVTeDd5Y0F3VEJKdVcwbmVXSnVYY1Jub01sUENTcjlWMExZTTl4TFNNUWVYd0ZKQWdnN0hVYnFvUjlTbmtaTmNIcDlPbjNEbUxpRHB1Q2l6SVduNnE3MERGTmVNYllobjdNQXB3OEJIVjA1WkVjbXpRN1lQWGVOaHRDOGY5R3ZFS0loV0xaVmxRM0xEZXo0djJQOFBLZEo0Wm5UTkZGLVd0dFZ5RklxTlZvamprSmF2ZTN5RW43cHpwWkUtaWU2cE9IUnBneHJMYmd4ZUxUMWxOR3U5SzdMTXpvMENSUGt3QzZLWnBWalZDMTVHQ0xtb21OYkotVUVXWXRaeUMzbFdEa2MyUzRweXNYUzZmUGhPVUtwa05waEVGdHktQ3cuVHllTm9lTDQ2STJHaFFGaE9jVWZwRmRMN3BzTkY3bGhMS00xMTlhWVBFVnB2NGcyNFY3aEotNkV2TDdBald5bkgtZkNhY1lXSllCbXlHdU5odWFIMHc%3D&_eventId=submit&geolocation=' \
//   --compressed";

  // $result = exec($cmd);

  // echo $result;

  // if (str_contains($result, 'Επιτυχής Σύνδεση')) 
  //   echo true;
  //  else echo false;

  ?>
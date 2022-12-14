<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="x-apple-disable-message-reformatting">
      <title></title>
     
      <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
      </style>
    </head>
    <body style="margin:0;padding:0;">
      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
          <td align="center" style="padding:0;">
            <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
              <tr>
                <td align="center" style="padding:40px 0 30px 0;background:#ffffff;">
                  <img src="https://i.ibb.co/FmQk7MC/Copy-removebg.png" alt="" width="300" style="height:auto;display:block;" />
                  <hr>
                </td>
              </tr>
              <tr>            
                <td style="padding:36px 30px 42px 30px;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                      <td style="padding:0 0 36px 0;color:#153643;">
                        <h1 style="font-size:24px;text-align:center;margin:0 0 20px 0;font-family:Arial,sans-serif;">{{$info['fullname']}}</h1><br>
                        <p style="margin:0 0 12px 0;text-align:center;font-size:20px;line-height:24px;font-family:Arial,sans-serif;"> {{$info['message']}}</p><br>
                        <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="mailto:{{$info['email']}}" style="color:#ee4c50;text-decoration:underline;">{{$info['email']}}</a></p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    </html>
    
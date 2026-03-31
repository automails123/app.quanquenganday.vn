<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mã xác thực OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
        <div style="padding: 30px; text-align: center;">
            <h2 style="color: #111827; margin-bottom: 10px;">Xác thực tài khoản</h2>
            <p style="color: #6b7280; font-size: 16px; text-align:left;">Xin chào,<br>
                Chúng tôi đã nhận được yêu cầu quên mật khẩu cho tài khoản của bạn tại app.quanquenganday.vn. Vui lòng sử dụng mã OTP dưới đây: </p>
            
            <div style="margin: 30px 0;">
                <span style="display: inline-block; font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #000000; background-color: #f3f4f6; padding: 15px 30px; border-radius: 10px; border: 1px dashed #d1d5db;">
                    {{ $otp }}
                </span>
            </div>

            <p style="color: #9ca3af; font-size: 13px; font-style: italic;">Mã này có hiệu lực trong vòng 10 phút. Vui lòng không chia sẻ mã này với bất kỳ ai.</p>
        </div>
        <div style="background-color: #f9fafb; padding: 15px; text-align: center; border-top: 1px solid #eee;">
            <p style="color: #9ca3af; font-size: 12px; margin: 0;">Đây là email tự động, vui lòng không phản hồi.</p>
        </div>
    </div>
</body>
</html>
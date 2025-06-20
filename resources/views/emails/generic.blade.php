<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Notification' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background-color: #003366;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header img {
            max-height: 50px;
            margin-bottom: 10px;
        }
        .email-body {
            padding: 30px;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f0f0f0;
            color: #666;
            font-size: 13px;
            text-align: center;
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff !important;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- En-tête -->
        <div class="email-header">
            <img src="{{ $logo ?? 'https://www.ekwatech.com/logo.png' }}" alt="Logo">
            <h2>{{ $companyName ?? 'Ekwatech' }}</h2>
        </div>

        <!-- Corps -->
        <div class="email-body">
            <h3>{{ $title ?? 'Bonjour,' }}</h3>
            <p>{!! nl2br(e($body ?? 'Contenu du message')) !!}</p>

            @if(isset($buttonText) && isset($buttonUrl))
                <a href="{{ $buttonUrl }}" >{{ $buttonText }}</a>
            @endif
        </div>

        <!-- Pied de page -->
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ $companyName ?? 'Ekwatech' }}. Tous droits réservés.<br>
            Cet email est généré automatiquement. Merci de ne pas y répondre.
        </div>
    </div>
</body>
</html>

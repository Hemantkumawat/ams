<?php

namespace App\Services;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Exception\ValidationException;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
    private static ?QrCodeService $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): QrCodeService
    {
        if (self::$instance === null) {
            self::$instance = new QrCodeService();
        }

        return self::$instance;
    }

    /**
     * @throws ValidationException
     */
    public function generateQrCode(string $text, ?string $logoPath = null, ?string $labelText = null): string
    {
        $writer = new PngWriter();

        $qrCode = QrCode::create($text)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logo = $logoPath ? Logo::create($logoPath)
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true) : null;

        $label = $labelText ? Label::create($labelText)
            ->setTextColor(new Color(255, 0, 0)) : null;
        $result = $writer->write($qrCode, $logo, $label);

        $writer->validateResult($result, $text);

        return $result->getDataUri();
    }
}

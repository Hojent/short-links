<?php
declare(strict_types=1);

namespace App\Services;


class LinkService
{
    public function generateShortLink($base, $currentPrefix)
    {
        $rand = $this->generateRandomString(8);
        if (!$currentPrefix) {
            return ['short_link' => 'a'.'_'.$rand];
        }
        $newPrefix = $this->getNewPrefix($base, $currentPrefix);
        if ($newPrefix['success']) {
            return [
                'short_link' => $newPrefix['prefix'].'_'.$rand
            ];
        } else {
            return ['error' => $newPrefix['message']];
        }
    }

    private function getNewPrefix($base, $currentStr)
    {
        $maxIndex = count($base)-1;
        $last = $base[$maxIndex];
        $first = $base[0];
        $maxCurrentIndex = count($currentStr)-1;
        for($i=$maxCurrentIndex; $i >= 0; $i-=1) {
            $originKey = array_search($currentStr[$i], $base);
            if ($i == $maxCurrentIndex ) {
                if($currentStr[$i] != $last) {
                    $currentStr[$i] = $base[$originKey + 1];
                    break;
                } else {
                    $currentStr[$i] = $base[0];
                    if(isset($currentStr[$i-1])) {
                        $currentStr[$i-1] = $this->setBit($currentStr[$i-1], $base);                                        } else {
                        $currentStr[$i] = $first;
                        $currentStr[] = $first;
                    }
                }
            } else {
                if($currentStr[$i] != $last) {
                    $currentStr[$i] = $base[$originKey + 1];
                    break;
                } else {
                    $currentStr[$i] = $base[0];
                    if(isset($currentStr[$i-1])) {
                        $currentStr[$i - 1] = $this->setBit($currentStr[$i - 1], $base);
                    } else {
                        $currentStr[$i] = $first;
                        $currentStr[] = $first;
                    }
                }
            }
        }
        if (count($currentStr) > $maxIndex+1) {
            return ['success' => false, 'message' => 'Исчерпан лимит ссылок'];
        } else {
            return ['success' => true, 'prefix' => implode($currentStr)];
        }
    }

    private function setBit($value, $example)
    {
        $originKey = array_search($value, $example);
        $row = $example[$originKey];
        return $row;
    }

    private function generateRandomString($length = 8) {
        $bytes = random_bytes($length);
        $randomString = substr(bin2hex($bytes), 0, $length);

        return $randomString;
    }
}
<?php

namespace App\Domain\Sections\HtmlSections;

use App\Domain\Sections\Actions\GetAvatars;

class Avatars
{
    private $avatars;
    private $currentAvatar;
    /**
     * @var mixed
     */
    public function __construct()
    {
        $this->avatars = (new GetAvatars())->execute();
    }

    public function getAvatars($gender = null)
    {
        if (!$gender) {
            return $this->avatars;
        }

        return collect($this->avatars)
            ->filter(function ($avatar) use ($gender) {
                return $avatar['gender'] == $gender;
            });
    }

    public function getAvatar($gender = null)
    {
        if (collect($this->avatars)->filter(function ($avatar) use ($gender) {
            return $avatar->gender == $gender;
        })->count() == 0) {
            $this->avatars = (new GetAvatars())->execute();
        }

        $avatar = collect($this->avatars)->filter(function ($avatar) use ($gender) {
            return $avatar->gender == $gender;
        })
//            ->shuffle()
            ->first();

        $this->avatars = collect($this->avatars)
            ->filter(function ($avt) use ($avatar) {
                return $avt['id'] != $avatar['id'];
            });

        $this->currentAvatar = $avatar;

        return $avatar;
    }

    public function getCurrentAvatar()
    {
        return $this->currentAvatar;
    }

    public static function getRandomAvatar()
    {
        $avatars = self::getAvatars();
        $rand = random_int(0, count($avatars) - 1);

        return $avatars[$rand];
    }
}

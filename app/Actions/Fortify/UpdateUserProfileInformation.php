<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\ImageResize;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => 'nullable|numeric|digits_between:10,12',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:8192'],
        ])->validateWithBag('updateProfileInformation');

        $imagePath = $user->avatar;
        if (isset($input['avatar'])) {
            $obj = (object)$input;
            if ($obj->avatar) {
                $avatar = $obj->avatar;
                $extFile = $avatar->getClientOriginalExtension();
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $nameFile = Uuid::uuid1()->getHex() . '.' . $extFile;
                $imagePath = $avatar->storeAs('profile_img', $nameFile, 'public');

                $smallthumbnailpath = public_path('storage/profile_img/' . $nameFile);
                $imageInfo = ImageResize::getFileImageSize($smallthumbnailpath);
                if ($imageInfo) {
                    $width = $imageInfo['width'];
                    $height = $imageInfo['height'];
                }
                if ($width >= 185 || $height >= 185) {
                    ImageResize::createThumbnail($smallthumbnailpath, 185, 185);
                }
            }
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'bio' => $input['bio'],
                'avatar' => $imagePath,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}

<?php


namespace App\Services;


use App\Repositories\SystemConfigRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class SystemConfigService
{
    use CrudTrait, FileTrait;
    private const SITE_PHOTO_PATH = 'site/images';
    private const SITE_ICON_PATH = 'site/images/icon/';
    private const SITE_LOGO_PATH = 'site/images/logo/';
    private const SITE_BANNER_PATH = 'site/images/banner/';
    private const SITE_BACKGROUND_PATH = 'site/images/background/';


    public function __construct(SystemConfigRepository $systemConfigRepository)
    {
        $this->setActionRepository($systemConfigRepository);
    }

    public function saveUpdatedValues($request)
    {
        return DB::transaction(function () use ($request) {

            $icon = $this->findBy(['key' => 'site-icon'])->first();

            if(isset($request['site-icon'])){
                $file = $request['site-icon'];
                $photoName = 'icon'. $file->guessExtension();
                $file->storeAs(self::SITE_ICON_PATH, $photoName, $this->disk);
                $icon->update([
                    'value' => self::SITE_ICON_PATH . $photoName,
                ]);
            }


            $logo = $this->findBy(['key' => 'site-logo'])->first();

            if(isset($request['site-logo'])){
                $file = $request['site-logo'];
                $photoName = 'logo'. $file->guessExtension();
                $file->storeAs(self::SITE_LOGO_PATH, $photoName, $this->disk);
                $logo->update([
                    'value' => self::SITE_LOGO_PATH . $photoName,
                ]);
            }

            $banner = $this->findBy(['key' => 'site-banner'])->first();

            if(isset($request['site-banner'])){
                $file = $request['site-banner'];
                $photoName = 'banner'. $file->guessExtension();
                $file->storeAs(self::SITE_BANNER_PATH, $photoName, $this->disk);
                $banner->update([
                    'value' => self::SITE_BANNER_PATH . $photoName,
                ]);
            }


            $background = $this->findBy(['key' => 'site-background'])->first();
            if(isset($request['site-background'])){
                $file = $request['site-background'];
                $photoName = 'background'. $file->guessExtension();
                $file->storeAs(self::SITE_BACKGROUND_PATH, $photoName, $this->disk);
                $background->update([
                    'value' => self::SITE_BACKGROUND_PATH . $photoName,
                ]);
            }

            $contact = $this->findBy(['key' => 'contact'])->first();
            $contact->update(['value' => $request['contact']]);

            $email = $this->findBy(['key' => 'email'])->first();
            $email->update(['value' => $request['email']]);

            $menu_bn = $this->findBy(['key' => 'menu-title-bn'])->first();
            $menu_bn->update(['value' => $request['menu-title-bn']]);

            $menu_en = $this->findBy(['key' => 'menu-title-en'])->first();
            $menu_en->update(['value' => $request['menu-title-en']]);

            $copyright_link = $this->findBy(['key' => 'copyright-link'])->first();
            $copyright_link->update(['value' => $request['copyright-link']]);

            $copyright_title = $this->findBy(['key' => 'copyright-title'])->first();
            $copyright_title->update(['value' => $request['copyright-title']]);

            $title = $this->findBy(['key' => 'title'])->first();
            $title->update(['value' => $request['title']]);

            $address = $this->findBy(['key' => 'address'])->first();
            $address->update(['value' => $request['address']]);

            return
                [
                    $request->all(),
                    $icon, $logo, $banner, $background,
                    $contact, $email, $menu_bn, $menu_en, $copyright_link, $copyright_title, $title, $address
                ];
        });

    }

}

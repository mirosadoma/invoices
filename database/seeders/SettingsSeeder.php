<?php

namespace Database\Seeders;

use App\Models\Cities\City;
use App\Models\Settings\SiteConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SiteConfig
        SiteConfig::create([
            // 'ar'    => [
            //     'title'                 => 'الفواتير',
            //     'company_name'          => 'شركة شاذلى',
            //     'terms_and_conditions'  => '<h1>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج</h1>

            //                                     <h1>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج</h1>

            //                                     <p>&nbsp;</p>

            //                                     <h1>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام &quot;هنا يوجد محتوى نصي، هنا يوجد محتوى نصي&quot; فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج</h1>
            //                                 ',
            //     'locale'                => 'ar',
            //     'site_config_id'        => 1,
            //     'created_at'            => Carbon::now(),
            //     'updated_at'            => Carbon::now(),
            // ],
            'en'    => [
                'title'                 => 'Invoices',
                'company_name'          => 'Shazly Company',
                'terms_and_conditions'  => '<h1>There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the external appearance of the text or the form of paragraphs placed on the page that he reads. Therefore, the Lorem Ipsum method is used because it gives a natural distribution - to some extent - to the letters instead of using &quot;here there is textual content, here there is textual content&quot; and makes it (i.e. the letters) look like readable text. Many desktop publishing programs and web page editing programs use Lorem Ipsum by default as a template</h1>

                                                <p>There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the external appearance of the text or the form of paragraphs placed on the page that he reads. Therefore, the Lorem Ipsum method is used because it gives a natural distribution - to some extent - to the letters instead of using &quot;here there is textual content, here there is textual content&quot; and makes it (i.e. the letters) look like readable text. Many desktop publishing programs and web page editing programs use Lorem Ipsum by default as a template</p>

                                                <p>There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the external appearance of the text or the form of paragraphs placed on the page that he reads. Therefore, the Lorem Ipsum method is used because it gives a natural distribution - to some extent - to the letters instead of using &quot;here there is textual content, here there is textual content&quot; and makes it (i.e. the letters) look like readable text. Many desktop publishing programs and web page editing programs use Lorem Ipsum by default as a template</p>
                                            ',
                'locale'                => 'en',
                'site_config_id'        => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            'email'                     => "invoices@info.com",
            'phone'                     => +92003299,
            'tax'                       => 15,
            'close'                     => 0,
            'close_msg'                 => '<h1><em><span dir=\"rtl\"><big><strong>قريباً بإذن الله ......</strong></big></span></em></h1>',
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
        ]);
    }

}

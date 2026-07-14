<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Organization;
use App\Models\Donation;
use App\Models\Message;
use App\Models\Hadith;
use App\Models\HadithCategory;
use App\Models\QuranVerse;
use App\Models\QuranTopic;
use App\Models\ZakatRule;
use App\Models\Campaign;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Arrays for realistic data
        $firstNames = ['Ali', 'Ahmad', 'Muhammad', 'Hassan', 'Hussain', 'Usman', 'Umar', 'Abu Bakr', 'Bilal', 'Zaid', 'Saad', 'Talha', 'Zubair', 'Abdur Rahman', 'Hamza', 'Khalid', 'Tariq', 'Zain', 'Faizan', 'Rizwan', 'Kamran', 'Imran', 'Irfan', 'Salman', 'Noman', 'Adnan', 'Farhan', 'Kashif', 'Asif', 'Wasim', 'Aamir', 'Nasir', 'Yasir', 'Tahir', 'Zahid', 'Sajid', 'Majid', 'Nadeem', 'Waseem', 'Naeem', 'Faisal', 'Adeel', 'Shakeel', 'Aqeel', 'Jaleel', 'Khaleel', 'Fatima', 'Aisha', 'Khadija', 'Zainab', 'Maryam', 'Hafsa', 'Ruqayyah', 'Umm Kulthum', 'Safiyya', 'Maimoona', 'Sana', 'Hina', 'Kiran', 'Sadia', 'Nida', 'Sobia', 'Fozia', 'Shazia', 'Nazia', 'Saima', 'Uzma', 'Asma', 'Salma', 'Najma', 'Bushra', 'Ishrat', 'Nusrat', 'Musarrat', 'Shabana', 'Rukhsana', 'Farzana', 'Rizwana', 'Shabina', 'Rubina', 'Samina', 'Tahira', 'Zahida', 'Sajida', 'Majida', 'Nadeema', 'Waseema', 'Naeema', 'Amina', 'Mominah', 'Nabeela'];
        $lastNames = ['Khan', 'Ahmed', 'Ali', 'Hussain', 'Shah', 'Qureshi', 'Malik', 'Awan', 'Rajput', 'Jat', 'Gujjar', 'Baloch', 'Pathan', 'Syed', 'Sheikh', 'Ansari', 'Memon', 'Khawaja', 'Abbasi', 'Chaudhry', 'Bhatti', 'Ghumman', 'Cheema', 'Chattha', 'Sandhu', 'Tarrar', 'Virk', 'Waraich', 'Gondal', 'Ranjha', 'Sial', 'Khokhar', 'Kharal', 'Magsi', 'Bugti', 'Marri', 'Mengal', 'Bizenjo', 'Zehri', 'Rind', 'Talpur', 'Lashari', 'Nizamani', 'Makhdoom', 'Qazi', 'Pirzada', 'Mirza', 'Baig', 'Chughtai', 'Lodhi', 'Ghauri', 'Suri', 'Durrani', 'Yusufzai', 'Afridi', 'Shinwari', 'Orakzai', 'Bangash', 'Khattak', 'Mahsud', 'Wazir', 'Dawari', 'Bannuchi', 'Marwat', 'Niazi', 'Gabol'];
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Sialkot', 'Gujranwala', 'Hyderabad', 'Abbottabad', 'Bahawalpur', 'Sukkur', 'Larkana', 'Nawabshah', 'Mirpurkhas', 'Sargodha', 'Sahiwal', 'Okara', 'Kasur', 'Sheikhupura', 'Jhang', 'Chiniot', 'Mandi Bahauddin', 'Gujrat', 'Jhelum', 'Chakwal', 'Attock', 'Mianwali', 'Bhakkar', 'Layyah', 'Muzaffargarh', 'Dera Ghazi Khan', 'Rajanpur', 'Rahim Yar Khan', 'Bahawalnagar', 'Vehari', 'Pakpattan', 'Lodhran', 'Khanewal', 'Toba Tek Singh', 'Hafizabad', 'Narowal', 'Nankana Sahib', 'Khushab', 'Swat', 'Mardan', 'Nowshera', 'Charsadda', 'Swabi', 'Kohat', 'Bannu', 'Dera Ismail Khan', 'Tank', 'Karak', 'Hangu', 'Mansehra', 'Haripur', 'Batagram', 'Kohistan', 'Shangla', 'Buner', 'Malakand', 'Dir', 'Chitral'];
        
        $overseasCities = ['Dubai (UAE)', 'Abu Dhabi (UAE)', 'London (UK)', 'Birmingham (UK)', 'Manchester (UK)', 'New York (USA)', 'Houston (USA)', 'Chicago (USA)', 'Toronto (Canada)', 'Vancouver (Canada)'];

        $orgNames = [
            'Al Khidmat Foundation', 'Saylani Welfare', 'Edhi Foundation', 'Akhuwat Foundation', 
            'Shaukat Khanum Donation Wing', 'Chhipa Welfare', 'Transparent Hands', 'JDC Welfare Organization',
            'Sahara for Life Trust', 'TCF (The Citizens Foundation)', 'Aman Foundation', 'Bait-ul-Sukoon',
            'Dar-ul-Sukun', 'Fatimid Foundation', 'SIUT', 'Indus Hospital', 'SOS Children\'s Villages',
            'Islamic Relief Pakistan', 'Muslim Hands Pakistan', 'Penny Appeal Pakistan', 'Al Mustafa Welfare Society'
        ];

        $users = [];

        // 1. Create Users
        $roles = array_merge(
            array_fill(0, 35, 'donor'),
            array_fill(0, 35, 'receiver'),
            array_fill(0, 15, 'organization'),
            array_fill(0, 10, 'user'),
            array_fill(0, 3, 'admin'),
            array_fill(0, 2, 'super_admin')
        );

        shuffle($roles);

        $password = Hash::make('password123'); // So they can login

        // Ensure 100 users exactly according to roles array size (100)
        foreach ($roles as $index => $role) {
            $isOverseas = ($role == 'donor' && rand(1, 100) <= 20); // 20% donors are overseas
            $isAnonymous = rand(1, 100) <= 10;
            
            if ($isAnonymous) {
                $name = $role == 'donor' ? 'Anonymous Donor' : 'Anonymous Receiver';
            } else {
                $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
            }
            
            $city = $isOverseas ? $overseasCities[array_rand($overseasCities)] : $cities[array_rand($cities)];
            
            // Unique email
            $email = strtolower(str_replace([' ', '(', ')'], '', $name)) . $index . rand(100, 999) . '@example.com';

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'status' => 'active',
                'trust_score' => rand(50, 100),
                'phone' => '+923' . rand(00, 49) . rand(1000000, 9999999),
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now(),
            ]);

            // Assuming user profiles exist in DB, we'll mark some verified
            $user->is_verified = rand(1, 100) <= 80; // 80% verified
            $user->save();

            $users[] = $user;
        }

        // 2. Create Organizations
        $orgUsers = collect($users)->where('role', 'organization')->values();
        $organizations = [];
        
        foreach ($orgNames as $i => $orgName) {
            if ($i >= $orgUsers->count()) break; // limit to available org users
            
            $user = $orgUsers[$i];
            
            $org = Organization::create([
                'user_id' => $user->id,
                'name' => $orgName,
                'slug' => Str::slug($orgName) . '-' . rand(10, 99),
                'description' => "Official profile for $orgName. We provide various welfare services to those in need across Pakistan.",
                'city' => $cities[array_rand($cities)],
                'country' => 'Pakistan',
                'phone' => '+9221' . rand(1111111, 9999999),
                'email' => strtolower(str_replace(' ', '', $orgName)) . '@example.org',
                'website' => 'https://www.' . strtolower(str_replace([' ', '\''], '', $orgName)) . '.org',
                'status' => 'approved',
                'is_verified' => true,
                'is_featured' => rand(1, 100) <= 30, // 30% featured
                'registration_number' => 'REG-' . rand(10000, 99999),
                'created_at' => $user->created_at,
                'updated_at' => now(),
            ]);
            $organizations[] = $org;
        }

        // 3. Create Donations
        $donors = collect($users)->whereIn('role', ['donor', 'user', 'super_admin'])->values();
        $receivers = collect($users)->where('role', 'receiver')->values();
        
        $types = ['zakat', 'sadaqa', 'emergency', 'general'];
        $methods = ['JazzCash', 'EasyPaisa', 'Bank Transfer', 'Debit Card'];

        for ($i = 0; $i < 250; $i++) {
            $donor = $donors->random();
            $isToOrg = rand(1, 100) <= 70; // 70% to orgs
            $orgId = null;
            
            if ($isToOrg && count($organizations) > 0) {
                $orgId = $organizations[array_rand($organizations)]->id;
            }
            
            Donation::create([
                'user_id' => $donor->id,
                'organization_id' => $orgId,
                'amount' => rand(5, 5000) * 100, // 500 to 500,000
                'type' => $types[array_rand($types)],
                'status' => 'completed',
                'transaction_id' => 'TXN' . strtoupper(Str::random(10)),
                'payment_method' => $methods[array_rand($methods)],
                'is_anonymous' => rand(1, 100) <= 20, // 20% anonymous
                'created_at' => now()->subDays(rand(1, 300)),
                'updated_at' => now(),
            ]);
        }

        // 4. Create Messages
        $subjects = ['Assistance Request', 'Donation Confirmation', 'Account Verification', 'Thank You!', 'Support Inquiry'];
        $bodies = [
            'Hello, I would like to request assistance for medical bills.',
            'Thank you for your generous donation to our cause.',
            'Your account has been verified successfully.',
            'May Allah reward you for your charity.',
            'Please let me know how I can contribute to the emergency fund.',
            'We have received your Zakat and distributed it to the needy.',
            'I need help with my children\'s education fees.',
            'Can you guide me on how to calculate Zakat on gold?',
        ];

        for ($i = 0; $i < 100; $i++) {
            $fromUser = collect($users)->random();
            $toUser = collect($users)->random();
            
            if ($fromUser->id === $toUser->id) continue;

            Message::create([
                'from_user_id' => $fromUser->id,
                'to_user_id' => $toUser->id,
                'subject' => $subjects[array_rand($subjects)],
                'body' => $bodies[array_rand($bodies)],
                'is_read' => rand(1, 100) <= 60, // 60% read
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now(),
            ]);
        }

        // 5. Create Hadith
        // Need categories first
        $hadithCat = HadithCategory::firstOrCreate(['name' => 'Charity & Zakat', 'slug' => 'charity-zakat', 'is_active' => true]);
        
        $hadithTopics = ['Zakat', 'Charity', 'Prayer', 'Patience', 'Gratitude'];
        for ($i = 1; $i <= 35; $i++) {
            $topic = $hadithTopics[array_rand($hadithTopics)];
            Hadith::create([
                'category_id' => $hadithCat->id,
                'arabic_text' => 'إِنَّمَا الأَعْمَالُ بِالنِّيَّاتِ... (Dummy Arabic for ' . $topic . ')',
                'urdu_translation' => 'تمام اعمال کا دارومدار نیتوں پر ہے... (Urdu for ' . $topic . ')',
                'english_translation' => 'Actions are judged by intentions... (English for ' . $topic . ')',
                'source' => 'Sahih Bukhari',
                'hadith_number' => rand(1, 7000),
                'grade' => 'Sahih',
                'is_featured' => rand(1, 100) <= 20,
                'is_active' => true,
            ]);
        }

        // 6. Create Quran Verses
        $quranTopic = QuranTopic::firstOrCreate(['name' => 'Wealth & Charity', 'slug' => 'wealth-charity', 'is_active' => true]);
        
        $verseTopics = ['Charity', 'Zakat', 'Prayer', 'Helping Others', 'Wealth', 'Gratitude'];
        for ($i = 1; $i <= 35; $i++) {
            $topic = $verseTopics[array_rand($verseTopics)];
            QuranVerse::create([
                'topic_id' => $quranTopic->id,
                'surah_name' => 'Al-Baqarah',
                'surah_number' => 2,
                'ayah_number' => rand(1, 286),
                'arabic_text' => 'وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ... (Dummy Arabic for ' . $topic . ')',
                'urdu_translation' => 'اور نماز قائم کرو اور زکوٰۃ ادا کرو... (Urdu for ' . $topic . ')',
                'english_translation' => 'And establish prayer and give zakah... (English for ' . $topic . ')',
                'reflection' => 'This verse reminds us of the importance of ' . $topic . '.',
                'is_featured' => rand(1, 100) <= 20,
                'is_active' => true,
            ]);
        }

        // 7. Create Zakat Rules
        $ruleMappings = [
            'gold' => 'Gold',
            'silver' => 'Silver',
            'cash' => 'Cash',
            'general' => 'Business',
            'property' => 'Property',
            'agricultural' => 'Agriculture',
            'livestock' => 'Livestock',
            'crypto' => 'Cryptocurrency',
            'stocks' => 'Shares'
        ];
        
        $idx = 0;
        foreach ($ruleMappings as $dbType => $displayType) {
            ZakatRule::create([
                'asset_type' => $dbType,
                'title' => "Zakat Rules for $displayType",
                'content' => "Detailed guidelines on how to calculate Zakat for $displayType. The Nisab threshold must be met, and 2.5% is generally applied for monetary assets.",
                'islamic_references' => "Based on rulings from prominent Islamic scholars regarding $displayType.",
                'scholarly_explanations' => "Modern fatwas suggest the following calculations for $displayType.",
                'order' => $idx + 1,
                'is_active' => true,
            ]);
            $idx++;
        }
    }
}

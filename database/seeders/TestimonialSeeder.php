<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuccessStory;
use App\Models\DonorReview;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $names = ['Ali Khan', 'Fatima Ahmed', 'Usman Qureshi', 'Ayesha Malik', 'Bilal Hussain', 'Zainab Shah', 'Hassan Raza', 'Maryam Tariq', 'Hamza Abbasi', 'Sana Baloch', 'Omar Farooq', 'Sadia Rajput', 'Faisal Sheikh', 'Hina Ansari', 'Zaid Memon'];
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Hyderabad', 'Sukkur', 'Sialkot', 'Gujranwala'];
        
        $userTypes = ['widow', 'orphan', 'student', 'small_business_owner', 'patient', 'daily_wage_worker', 'flood_victim', 'disabled', 'anonymous'];
        $storyTitles = [
            'Zakat Helped Me Restart My Small Business', 'Your Zakat Saved My Family', 'Hope After the Flood',
            'My Children\'s Education Continued', 'A New Beginning Through Zakat', 'Education Became Possible Again',
            'From Despair to Hope', 'My Medical Treatment Was Completed'
        ];
        $stories = [
            'I lost everything in the recent floods, but thanks to the generous donors on this platform, I was able to rebuild my home and restart my small business.',
            'Being a widow with three children was incredibly tough. Zakat funds helped me pay for their schooling and secure a steady income.',
            'I needed urgent surgery but could not afford it. The medical fund supported by donors covered my entire hospital bill.',
            'As a daily wage worker, feeding my family was a daily struggle. The financial assistance gave me the breathing room to find a stable job.',
            'I had to drop out of university due to financial constraints. Your Zakat enabled me to pay my tuition and graduate.',
            'My shop burned down in an accident. The business support grant helped me buy new inventory and get back on my feet.',
        ];

        // Generate 50 Success Stories
        for ($i = 0; $i < 50; $i++) {
            $isAnonymous = rand(1, 100) <= 15;
            $name = $isAnonymous ? 'Anonymous' : $names[array_rand($names)];
            
            SuccessStory::create([
                'full_name' => $name,
                'city' => $cities[array_rand($cities)],
                'user_type' => $userTypes[array_rand($userTypes)],
                'title' => $storyTitles[array_rand($storyTitles)],
                'story' => $stories[array_rand($stories)],
                'amount_received' => rand(5000, 200000),
                'rating' => 5,
                'is_verified' => true,
                'is_featured' => rand(1, 100) <= 20,
            ]);
        }

        $donationTypes = ['Zakat', 'Sadaqah', 'Emergency Fund', 'General Donation'];
        $reviews = [
            'The platform is transparent and trustworthy.',
            'My donation reached the right family. I saw the impact immediately.',
            'Excellent verification system. I feel confident donating here.',
            'I received updates after donating. Great transparency.',
            'Very professional platform. Everything is clearly documented.',
            'Highly recommended for Zakat. They ensure it goes to the most deserving.',
            'The process was smooth and secure.',
            'I will definitely donate again. Keep up the good work.',
        ];

        // Generate 50 Donor Reviews
        for ($i = 0; $i < 50; $i++) {
            $isAnonymous = rand(1, 100) <= 15;
            $name = $isAnonymous ? 'Anonymous Donor' : $names[array_rand($names)];
            
            DonorReview::create([
                'donor_name' => $name,
                'city' => $cities[array_rand($cities)],
                'donation_type' => $donationTypes[array_rand($donationTypes)],
                'donation_amount' => rand(1000, 100000),
                'review' => $reviews[array_rand($reviews)],
                'rating' => rand(4, 5),
                'is_verified' => true,
                'is_featured' => rand(1, 100) <= 20,
            ]);
        }
    }
}

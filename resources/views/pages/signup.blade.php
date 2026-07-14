@extends('layouts.app')

@section('content')

<style>
  [x-cloak] { display: none !important; }

  .glass-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
  }
  
  [data-theme='dark'] .glass-card {
      background: rgba(30, 30, 30, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.05);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
  }

  .form-group {
      margin-bottom: 1.5rem;
      display: flex;
      flex-direction: column;
  }
  
  .form-label {
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
      font-size: 0.95rem;
  }
  
  [data-theme='dark'] .form-label {
      color: #e2e8f0;
  }

  .form-input, .form-select, .form-textarea {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1px solid var(--border);
      border-radius: 12px;
      background: transparent;
      transition: all 0.2s ease;
      font-family: 'DM Sans', sans-serif;
      color: inherit;
  }

  .form-input:focus, .form-select:focus, .form-textarea:focus {
      border-color: var(--emerald);
      outline: none;
      box-shadow: 0 0 0 4px rgba(36, 138, 95, 0.1);
  }

  .type-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
  }
  
  .type-card:hover {
      transform: translateY(-5px);
      border-color: var(--emerald);
      box-shadow: 0 10px 25px -5px rgba(36, 138, 95, 0.15);
  }

  .type-card.selected {
      border-color: var(--emerald);
      background-color: rgba(36, 138, 95, 0.05);
      box-shadow: 0 0 0 2px var(--emerald);
  }

  .custom-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      border: 1px solid var(--border);
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.2s;
  }
  
  .custom-checkbox:hover {
      background: rgba(36, 138, 95, 0.05);
  }
  
  .custom-checkbox input:checked + span {
      color: var(--emerald);
      font-weight: 600;
  }

  .file-upload-box {
      border: 2px dashed var(--border);
      border-radius: 12px;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
  }
  .file-upload-box:hover {
      border-color: var(--emerald);
      background: rgba(36, 138, 95, 0.02);
  }

</style>

<section class="section" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding-top: 100px; padding-bottom: 60px;">
    
    <!-- Alpine App -->
    <div x-data="registrationForm()" class="mx-auto px-4 w-full" style="max-width: 80%;">
        
        <div class="glass-card rounded-[24px] p-6 md:p-12 relative w-full">

            <!-- Global Error Banner -->
            <div x-show="globalError" x-text="globalError" x-cloak class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200 text-sm font-medium" x-transition></div>

            <form @submit.prevent="submitForm" id="regForm">
                
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold font-['Playfair_Display'] mb-3">Join ZARIYAH</h2>
                    <p class="text-gray-500 font-medium">Choose how you want to interact with our platform.</p>
                </div>

                <!-- Type Selection Cards -->
                <div class="grid md:grid-cols-2 gap-6 mb-12">
                    
                    <!-- Donor Card -->
                    <div class="type-card border rounded-2xl p-8 text-center flex flex-col h-full" 
                         :class="{'selected': form.registration_type === 'donor'}"
                         @click="form.registration_type = 'donor'">
                        <div class="w-16 h-16 rounded-full bg-[rgba(36,138,95,0.1)] text-[var(--emerald)] flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Become a Donor</h3>
                        <p class="text-gray-500 text-sm flex-grow mb-6">Help people through Zakat, Sadaqah, and continuous Donations.</p>
                        <div class="w-full py-3 rounded-xl font-semibold text-sm transition-colors mt-auto"
                             :class="form.registration_type === 'donor' ? 'bg-[var(--emerald)] text-white' : 'bg-gray-100 text-gray-500'">
                            Select
                        </div>
                    </div>

                    <!-- Receiver Card -->
                    <div class="type-card border rounded-2xl p-8 text-center flex flex-col h-full"
                         :class="{'selected': form.registration_type === 'receiver_individual' || form.registration_type === 'receiver_organization'}"
                         @click="form.registration_type = form.registration_type.startsWith('receiver') ? form.registration_type : 'receiver_individual'">
                        <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Become a Receiver</h3>
                        <p class="text-gray-500 text-sm flex-grow mb-6">Receive financial assistance from verified donors and campaigns.</p>
                        <div class="w-full py-3 rounded-xl font-semibold text-sm transition-colors mt-auto"
                             :class="(form.registration_type === 'receiver_individual' || form.registration_type === 'receiver_organization') ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-500'">
                            Select
                        </div>
                    </div>

                </div>

                <!-- Registration Form (Visible after selection) -->
                <div x-show="form.registration_type !== ''" x-cloak x-transition.opacity.duration.400ms>
                    <hr class="mb-10 border-gray-200">

                    <h3 class="text-2xl font-bold font-['Playfair_Display'] mb-6">Registration Details</h3>

                    <div class="grid md:grid-cols-2 gap-x-12 gap-y-4">
                        
                        <!-- Left Column -->
                        <div>
                            
                            <!-- Receiver Type (Moved to top of left column for visibility) -->
                            <div class="form-group" x-show="form.registration_type.startsWith('receiver')">
                                <label class="form-label text-[var(--emerald)] font-bold">Are you registering as an Individual or an Organization? *</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="custom-checkbox flex-1 justify-center" :class="{'bg-[rgba(36,138,95,0.1)] border-[var(--emerald)]': form.registration_type === 'receiver_individual'}">
                                        <input type="radio" value="receiver_individual" x-model="form.registration_type" class="hidden">
                                        <span class="text-sm">👤 Individual</span>
                                    </label>
                                    <label class="custom-checkbox flex-1 justify-center" :class="{'bg-[rgba(36,138,95,0.1)] border-[var(--emerald)]': form.registration_type === 'receiver_organization'}">
                                        <input type="radio" value="receiver_organization" x-model="form.registration_type" class="hidden">
                                        <span class="text-sm">🏢 Organization (Idara)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label class="form-label" x-text="form.registration_type === 'receiver_organization' ? 'Contact Person Name' : 'Full Name'"></label>
                                <input class="form-input" type="text" x-model="form.name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input class="form-input" type="email" x-model="form.email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mobile Number</label>
                                <input class="form-input" type="text" x-model="form.phone" required>
                            </div>
                            
                            <!-- CNIC (Only for Individual or Donor) -->
                            <div class="form-group" x-show="form.registration_type !== 'receiver_organization'">
                                <label class="form-label">CNIC (XXXXX-XXXXXXX-X)</label>
                                <input class="form-input" type="text" x-model="form.cnic" @input="formatCNIC" :required="form.registration_type !== 'receiver_organization'">
                            </div>

                            <div class="form-group">
                                <label class="form-label" x-text="form.registration_type === 'receiver_organization' ? 'Organization Complete Address' : 'Complete Address'"></label>
                                <input class="form-input" type="text" x-model="form.address" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input class="form-input" type="text" x-model="form.city" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input class="form-input" type="password" x-model="form.password" @input="checkPasswordStrength" required minlength="8">
                                <!-- Password Strength Meter -->
                                <div class="flex gap-1 mt-2">
                                    <div class="h-1 flex-1 rounded-full bg-gray-200" :class="{'bg-red-500': pwdStrength > 0}"></div>
                                    <div class="h-1 flex-1 rounded-full bg-gray-200" :class="{'bg-yellow-400': pwdStrength > 1}"></div>
                                    <div class="h-1 flex-1 rounded-full bg-gray-200" :class="{'bg-green-500': pwdStrength > 2}"></div>
                                    <div class="h-1 flex-1 rounded-full bg-gray-200" :class="{'bg-[var(--emerald)]': pwdStrength > 3}"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input class="form-input" type="password" x-model="form.password_confirmation" required minlength="8">
                            </div>

                            <div class="form-group mt-4">
                                <label class="form-label">Bank Name (Optional)</label>
                                <input class="form-input" type="text" x-model="form.bank_name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Account Title</label>
                                <input class="form-input" type="text" x-model="form.account_title">
                            </div>
                            <div class="form-group">
                                <label class="form-label">IBAN</label>
                                <input class="form-input" type="text" x-model="form.iban">
                            </div>
                        </div>

                    </div>

                    <!-- Conditional Sections based on Type -->
                    <div class="mt-8 border-t pt-8">

                        <!-- Organization Specific Fields -->
                        <div x-show="form.registration_type === 'receiver_organization'" x-cloak>
                            <h4 class="font-bold mb-4 text-lg">Organization (Idara) Details</h4>
                            
                            <div class="form-group mb-6">
                                <label class="form-label text-[var(--emerald)] font-bold">Is the organization certified/registered with the government? *</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="custom-checkbox">
                                        <input type="radio" value="yes" x-model="form.is_certified" class="hidden">
                                        <span>Yes, Certified</span>
                                    </label>
                                    <label class="custom-checkbox">
                                        <input type="radio" value="no" x-model="form.is_certified" class="hidden">
                                        <span>No, Unregistered</span>
                                    </label>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-x-12 gap-y-4 mb-6">
                                <div class="form-group">
                                    <label class="form-label">Organization Name</label>
                                    <input class="form-input" type="text" x-model="form.org_name" :required="form.registration_type === 'receiver_organization'">
                                </div>
                                <div class="form-group" x-show="form.is_certified === 'yes'">
                                    <label class="form-label">Registration Number</label>
                                    <input class="form-input" type="text" x-model="form.registration_number">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">License Upload</label>
                                    <div class="file-upload-box" @click="$refs.ngo_license.click()">
                                        <input type="file" x-ref="ngo_license" @change="handleFile($event, 'ngo_license')" class="hidden" accept=".jpg,.png,.pdf">
                                        <div x-show="!files.ngo_license"><span class="text-2xl mb-2 block">📄</span><span class="text-sm">Click to upload</span></div>
                                        <div x-show="files.ngo_license" class="text-[var(--emerald)]"><span class="text-xl">✅</span> <span x-text="files.ngo_license?.name" class="text-sm truncate block max-w-full"></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Verification Document</label>
                                    <div class="file-upload-box" @click="$refs.gov_reg_cert.click()">
                                        <input type="file" x-ref="gov_reg_cert" @change="handleFile($event, 'gov_reg_cert')" class="hidden" accept=".jpg,.png,.pdf">
                                        <div x-show="!files.gov_reg_cert"><span class="text-2xl mb-2 block">📄</span><span class="text-sm">Click to upload</span></div>
                                        <div x-show="files.gov_reg_cert" class="text-[var(--emerald)]"><span class="text-xl">✅</span> <span x-text="files.gov_reg_cert?.name" class="text-sm truncate block max-w-full"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donor Specific Fields -->
                        <div x-show="form.registration_type === 'donor'" x-cloak>
                            <h4 class="font-bold mb-4 text-lg">Donation Preferences</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <template x-for="item in ['Education', 'Medical', 'Food', 'Orphans', 'Emergency Relief', 'Mosque Projects', 'Water Wells', 'Other']">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" :value="item" x-model="form.preferences" class="w-4 h-4 text-[var(--emerald)] border-gray-300 rounded focus:ring-[var(--emerald)]">
                                        <span x-text="item" class="text-sm"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Individual Receiver Specific Fields -->
                        <div x-show="form.registration_type === 'receiver_individual'" x-cloak>
                            <h4 class="font-bold mb-4 text-lg">Assistance Required</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <template x-for="item in ['Food', 'Medical', 'Education', 'Debt', 'Shelter', 'Utility Bills', 'Marriage', 'Emergency', 'Business Support', 'Other']">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" :value="item" x-model="form.assistance_required" class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                                        <span x-text="item" class="text-sm"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Common Documents -->
                        <div x-show="form.registration_type === 'donor' || form.registration_type === 'receiver_individual'" x-cloak>
                            <h4 class="font-bold mb-4 text-lg">Identity Documents</h4>
                            <div class="grid md:grid-cols-2 gap-6 mb-6">
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Front</label>
                                    <div class="file-upload-box" @click="$refs.cnic_front.click()">
                                        <input type="file" x-ref="cnic_front" @change="handleFile($event, 'cnic_front')" class="hidden" accept=".jpg,.png,.pdf">
                                        <div x-show="!files.cnic_front"><span class="text-2xl mb-2 block">📄</span><span class="text-sm">Click to upload</span></div>
                                        <div x-show="files.cnic_front" class="text-[var(--emerald)]"><span class="text-xl">✅</span> <span x-text="files.cnic_front?.name" class="text-sm truncate block max-w-full"></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Back</label>
                                    <div class="file-upload-box" @click="$refs.cnic_back.click()">
                                        <input type="file" x-ref="cnic_back" @change="handleFile($event, 'cnic_back')" class="hidden" accept=".jpg,.png,.pdf">
                                        <div x-show="!files.cnic_back"><span class="text-2xl mb-2 block">📄</span><span class="text-sm">Click to upload</span></div>
                                        <div x-show="files.cnic_back" class="text-[var(--emerald)]"><span class="text-xl">✅</span> <span x-text="files.cnic_back?.name" class="text-sm truncate block max-w-full"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-10 flex justify-end pt-6 border-t border-gray-100">
                        <button type="submit" class="btn-primary px-10 py-3 rounded-xl shadow-lg flex items-center gap-2" :disabled="isSubmitting" :class="{'opacity-75 cursor-wait': isSubmitting}">
                            <svg x-show="isSubmitting" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span x-text="isSubmitting ? 'Processing...' : 'Complete Registration'"></span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<!-- Include Alpine.js purely for this component -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registrationForm', () => ({
            isSubmitting: false,
            globalError: '',
            pwdStrength: 0,
            
            form: {
                registration_type: '',
                name: '', email: '', phone: '', password: '', password_confirmation: '',
                cnic: '', address: '', city: '',
                bank_name: '', account_title: '', iban: '',
                org_name: '', registration_number: '', is_certified: '',
                preferences: [], assistance_required: []
            },
            
            files: {
                cnic_front: null, cnic_back: null, gov_reg_cert: null, ngo_license: null
            },
            
            init() {
                const saved = localStorage.getItem('zariyah_onboarding_draft');
                if (saved) {
                    try {
                        const parsed = JSON.parse(saved);
                        delete parsed.password;
                        delete parsed.password_confirmation;
                        this.form = { ...this.form, ...parsed };
                    } catch(e) {}
                }

                setInterval(() => {
                    if (this.form.registration_type && !this.isSubmitting) {
                        localStorage.setItem('zariyah_onboarding_draft', JSON.stringify(this.form));
                    }
                }, 5000);
            },
            
            checkPasswordStrength() {
                let score = 0;
                const p = this.form.password || '';
                if(p.length >= 8) score++;
                if(/[A-Z]/.test(p)) score++;
                if(/[0-9]/.test(p)) score++;
                if(/[^A-Za-z0-9]/.test(p)) score++;
                this.pwdStrength = score;
            },

            formatCNIC(e) {
                let val = e.target.value.replace(/\D/g, '');
                if (val.length > 5) {
                    val = val.substring(0, 5) + '-' + val.substring(5);
                }
                if (val.length > 13) {
                    val = val.substring(0, 13) + '-' + val.substring(13, 14);
                }
                this.form.cnic = val;
            },

            handleFile(e, key) {
                if (e.target.files.length > 0) {
                    this.files[key] = e.target.files[0];
                }
            },
            
            async submitForm() {
                this.globalError = '';
                
                // Final validation checks
                if (!this.form.password) {
                    this.globalError = "Password is required.";
                    return;
                }
                if (this.form.password !== this.form.password_confirmation) {
                    this.globalError = "Passwords do not match.";
                    return;
                }
                if (this.form.password.length < 8) {
                    this.globalError = "Password must be at least 8 characters.";
                    return;
                }

                this.isSubmitting = true;
                
                let formData = new FormData();
                
                for (const key in this.form) {
                    if (Array.isArray(this.form[key])) {
                        formData.append(key, JSON.stringify(this.form[key]));
                    } else {
                        formData.append(key, this.form[key]);
                    }
                }
                
                for (const key in this.files) {
                    if (this.files[key]) {
                        formData.append(key, this.files[key]);
                    }
                }
                
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                try {
                    const response = await fetch("{{ route('signup.submit') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        localStorage.removeItem('zariyah_onboarding_draft');
                        window.location.href = data.redirect;
                    } else {
                        this.globalError = data.message || "An error occurred. Please check your inputs.";
                        if (data.errors) {
                            this.globalError = Object.values(data.errors)[0][0];
                        }
                    }
                } catch (error) {
                    this.globalError = "Network error. Please try again.";
                } finally {
                    this.isSubmitting = false;
                }
            }
        }));
    });
</script>

@endsection

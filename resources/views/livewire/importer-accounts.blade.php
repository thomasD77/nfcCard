<div>
    <div class="alert alert-dark fs-sm mt-2">
        <div class="mt-2">
            <p class="mb-0">
                <i class="fa fa-fw fa-info me-1 mt-0"></i>
                Select the accounts and enter a e-mail and password for them to generate.
                <br> Attention! The "green" users are existing member accounts.
                <br> <i class="fa fa-fw fa-info me-1 mt-0"></i>
                If you only want to regenerate a password and use the existing e-mail account then leave the input field for
                e-mail empty.
            </p>
        </div>
    </div>
    <form class="js-validation-signup" wire:submit.prevent="generateAccounts">
        @csrf
        <div class="py-3">

            <div class="mb-4">
                <input placeholder="email"
                       id="email"
                       type="email"
                       class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
                       wire:model="email"
                >
                <div wire:loading wire:target="email">
                    <i class="fa fa-sun fa-spin m-2"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-4">
                <div class="row">
                    <div class="col-9 col-md-10 pe-0">
                        <input placeholder="password"
                               id="password"
                               type="password"
                               class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror"
                               wire:model="password"
                               required
                        >
                    </div>
                    <div class="col-3 col-md-2">
                        <button type="button"
                                class="form-control text-center"
                                style="height: 100%"
                                onclick="myFunction()">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div wire:loading wire:target="password">
                        <i class="fa fa-sun fa-spin m-2"></i>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-4">
                <p class="text-muted mb-1">Password rules:</p>
                <ul>
                    <li class="text-muted"> At least one capital letter </li>
                    <li class="text-muted"> At least one letter</li>
                    <li class="text-muted"> At least one digit</li>
                    <li class="text-muted"> At least one symbol</li>
                </ul>
            </div>

            <div class="mb-4">
                <input placeholder="confirm password"
                       id="password-confirm"
                       type="password"
                       required
                       class="form-control form-control-lg form-control-alt"
                       wire:model="password_confirmation"
                >
                <div wire:loading wire:target="password_confirmation">
                    <i class="fa fa-sun fa-spin m-2"></i>
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                @if (session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session('success_message') }}
                    </div>
                @endif
                @if (session()->has('empty_message'))
                    <div class="alert alert-warning">
                        {{ session('empty_message') }}
                    </div>
                @endif
                @if (session()->has('success_update_message'))
                    <div class="alert alert-success">
                        {{ session('success_update_message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 col-xl-5">
                <div wire:loading wire:target="generateAccounts">
                    <i class="fa fa-4x fa-cog fa-spin text-dark mb-2"></i>
                </div>
                <button type="submit" class="btn w-100 btn-dark text-white" wire:target="generateAccounts"  wire:loading.attr="disabled">
                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Generate accounts
                </button>
            </div>
        </div>
    </form>

</div>

<?php

declare(strict_types=1);

namespace Narsil\Base\Livewire\Auth;

#region USE

use Illuminate\View\View;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Livewire\Component;
use Narsil\Base\Models\User;

#endregion

final class Login extends Component
{
    #region PROPERTIES

    /**
     * The login email address.
     *
     * @var string
     */
    public string $email = '';

    /**
     * The login password.
     *
     * @var string
     */
    public string $password = '';

    /**
     * Whether the session should be remembered.
     *
     * @var boolean
     */
    public bool $remember = false;

    #endregion

    #region PUBLIC METHODS

    /**
     * Attempt to authenticate the user through Fortify.
     *
     * @return mixed
     */
    public function login(): mixed
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $request = LoginRequest::createFrom(request());

        $request->merge([
            Fortify::username() => $this->email,
            User::PASSWORD => $this->password,
            User::REMEMBER => $this->remember,
        ]);

        return app(AuthenticatedSessionController::class)
            ->store($request);
    }

    /**
     * Render the login component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('narsil::livewire.auth.login');
    }

    #endregion
}

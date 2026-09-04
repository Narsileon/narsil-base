<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers;

#region USE

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

#endregion

abstract class RedirectController
{
    use AuthorizesRequests;

    #region CONSTANTS

    /**
     * The "back" parameter.
     *
     * @var string
     */
    final protected const BACK = '_back';

    /**
     * The "to" parameter.
     *
     * @var string
     */
    final protected const TO = '_to';

    #endregion

    #region PROTECTED METHODS

    /**
     * @param string|null $to
     * @param mixed $data
     *
     * @return RedirectResponse
     */
    protected function redirect(?string $to = null, mixed $data = []): RedirectResponse
    {
        $to = request(self::TO, $to);

        if (!$to || request()->input(self::BACK))
        {
            return back()
                ->with('data', $data);
        }

        return redirect($to);
    }

    #endregion
}

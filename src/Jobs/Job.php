<?php

declare(strict_types=1);

namespace Narsil\Base\Jobs;

#region USE

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

#endregion

abstract class Job implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    #region PUBLIC METHODS

    /**
     * Execute the job.
     *
     * @return void
     */
    abstract public function handle(): void;

    #endregion
}

<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\Jobs\FailedJob;
use Narsil\Base\Models\Jobs\Job;
use Narsil\Base\Models\Jobs\JobBatch;
use Narsil\Base\Traits\HasSchemas;

#endregion

return new class extends Migration
{
    use HasSchemas;

    #region PUBLIC METHODS

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $schema = $this->getFallbackSchema();

        if (!Schema::hasTable("$schema." . Job::TABLE))
        {
            $this->createJobsTable($schema);
        }
        if (!Schema::hasTable("$schema." . JobBatch::TABLE))
        {
            $this->createJobBatchesTable($schema);
        }
        if (!Schema::hasTable("$schema." . FailedJob::TABLE))
        {
            $this->createFailedJobsTable($schema);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $schema = $this->getFallbackSchema();

        Schema::dropIfExists("$schema." . FailedJob::TABLE);
        Schema::dropIfExists("$schema." . JobBatch::TABLE);
        Schema::dropIfExists("$schema." . Job::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the failed jobs table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createFailedJobsTable(string $schema): void
    {
        Schema::create("$schema." . FailedJob::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(FailedJob::ID);
            $blueprint
                ->string(FailedJob::UUID)
                ->unique();
            $blueprint
                ->text(FailedJob::CONNECTION);
            $blueprint
                ->text(FailedJob::QUEUE);
            $blueprint
                ->longText(FailedJob::PAYLOAD);
            $blueprint
                ->longText(FailedJob::EXCEPTION);
            $blueprint
                ->timestamp(FailedJob::FAILED_AT)
                ->useCurrent();
        });
    }

    /**
     * Create the job batches table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createJobBatchesTable(string $schema): void
    {
        Schema::create("$schema." . JobBatch::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->string(JobBatch::ID)
                ->primary();
            $blueprint
                ->string(JobBatch::NAME);
            $blueprint
                ->integer(JobBatch::TOTAL_JOBS);
            $blueprint
                ->integer(JobBatch::PENDING_JOBS);
            $blueprint
                ->integer(JobBatch::FAILED_JOBS);
            $blueprint
                ->longText(JobBatch::FAILED_JOB_IDS);
            $blueprint
                ->mediumText(JobBatch::OPTIONS)
                ->nullable();
            $blueprint
                ->integer(JobBatch::CANCELLED_AT)
                ->nullable();
            $blueprint
                ->integer(JobBatch::CREATED_AT);
            $blueprint
                ->integer(JobBatch::FINISHED_AT)
                ->nullable();
        });
    }

    /**
     * Create the jobs table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createJobsTable(string $schema): void
    {
        Schema::create("$schema." . Job::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(Job::ID);
            $blueprint
                ->string(Job::QUEUE)
                ->index();
            $blueprint
                ->longText(Job::PAYLOAD);
            $blueprint
                ->unsignedTinyInteger(Job::ATTEMPTS);
            $blueprint
                ->unsignedInteger(Job::RESERVED_AT)
                ->nullable();
            $blueprint
                ->unsignedInteger(Job::AVAILABLE_AT);
            $blueprint
                ->unsignedInteger(Job::CREATED_AT);
        });
    }

    #endregion
};

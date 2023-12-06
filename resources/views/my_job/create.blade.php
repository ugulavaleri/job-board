@php use App\Models\Job; @endphp
<x-layout>
    <x-breadcrumps :links="['My Jobs' => route('my-job.index'), 'Create' => '#']" class="mb-4"/>

    <x-card class="mb-8">
        <form action="{{ route('my-job.store') }}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="title">Job Title</label>
                    <x-text-input name="title"/>
                </div>

                <div>
                    <label for="location">Location</label>
                    <x-text-input name="location"/>
                </div>

                <div class="col-span-2">
                    <label for="salary">Salary</label>
                    <x-text-input name="salary" type="number"/>
                </div>

                <div class="col-span-2">
                    <label for="description">Description</label>
                    <x-text-input name="description" type="textarea"/>
                </div>

                <div>
                    <label for="experience">Experience</label>
                    <x-radio-group name="experience" :value="old('experience')"
                                   :allOption="false"
                                   :options="array_combine(
                                  array_map('ucfirst', Job::$experience),
                                    Job::$experience,
                )"/>
                </div>

                <div>
                    <label for="category">Category</label>
                    <x-radio-group name="category" :all-option="false" :value="old('category')"
                                   :options="Job::$category"/>
                </div>

                <div class="col-span-2">
                    <button class="w-full">Create Job</button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>

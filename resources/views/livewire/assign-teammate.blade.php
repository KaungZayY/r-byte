<div>
    <form wire:submit.prevent="submit" method="POST">
        @csrf
        <div class="px-16 md:px-40 lg:px-80">
            <div class="mt-4">
                <x-label for="ticket_name" value="{{ __('Ticket Name') }}" />
                <x-input id="ticket_name" class="block mt-1 w-full" type="text" name="ticket_name" value="{{$ticket->ticket_name}}" readonly />
            </div>
            <div class="mt-4">
                <x-label for="duration" value="{{ __('Duration (in minutes)') }}" />
                <x-input id="duration" class="block mt-1 w-full" type="number" name="duration" autofocus value="{{$ticket->duration}}" readonly />
            </div>
            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <x-text-area name="description" id="description" rows="4" class="w-full px-4 py-2" value="{{$ticket->description}}" readonly></x-text-area>
            </div>
            <div class="mt-4">
                <x-label for="team_id" value="{{ __('Team') }}" />
                <select wire:model.live='team_id' id="team_id" name="team_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">-- SELECT TEAM --</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}"}}>{{ $team->team_name }}</option>
                    @endforeach
                </select>
                @error('team_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="teammate_id" value="{{ __('Teammate') }}" />
                <select wire:model='teammate_id' id="teammate_id" name="teammate_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" {{$teammates == [] ? 'selected':''}}>-- SELECT TEAMMATES --</option>
                    @foreach($teammates as $teammate)
                        <option value="{{ $teammate->id }}">{{ $teammate->user->name }}</option>
                    @endforeach
                </select>
                @error('teammate_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-end mt-4 mb-2">
                <x-button-cancel :cancelRoute="route('tickets',['project'=>$project,'sprint'=>$ticket->sprint_id])">
                    {{__('Cancel')}}
                </x-button-cancel>

                <x-button class="ms-4">
                    {{ __('Add') }}
                </x-button>
            </div>
        </div>
    </form>
</div>

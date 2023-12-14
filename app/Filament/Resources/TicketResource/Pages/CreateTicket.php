<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status_id'] = 1; // id do status aberto
        $data['user_id'] = auth()->id();    
        return $data;
    }
}

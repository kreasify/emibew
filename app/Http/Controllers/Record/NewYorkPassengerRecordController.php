<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Models\NewYorkPassengerRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use MeiliSearch\Client as MeiliSearchClient;
use MeiliSearch\Endpoints\Indexes;

class NewYorkPassengerRecordController extends Controller
{
    //
    public function __construct(MeiliSearchClient $meilisearch)
    {
        $this->meilisearch = $meilisearch;
    }

    public function search( Request $request )
    {

//        get the input data ready
        $inputFields = $request->except('_token', 'first_name', 'last_name','action' );
//        prepare for filter
        if($request->action === "filter")
        {
            $inputQuery = $request->first_name." ".$request->last_name;
        }
//        prepare for search
        if($request->action === "search")
        {
            $inputQuery = Arr::join( $request->except('_token', 'action'), ' ');
        }

        $records = NewYorkPassengerRecord::search($inputQuery,
            function (Indexes $meilisearch, $query, $options) use ($request, $inputFields){
//            run the filter
                if($request->action === "filter") {
                    foreach($inputFields as  $fieldname => $fieldvalue){
                        if(!empty($fieldvalue)) {
                            $options['filter'] = ['"'.$fieldname.'"="' . $fieldvalue . '"'];
                        }
                    }
                }
                return $meilisearch->search($query, $options);
            })->paginate();
//        get the filter attributes
        $filterAttributes = $this->meilisearch->index('new_york_passenger_records')->getFilterableAttributes();
//        get the keywords again
        $keywords = $request->all();
//        return view
        return view('dashboard.NewYorkPassengerRecord.records', compact('records',  'keywords','filterAttributes'))->with($request->all());
    }
}

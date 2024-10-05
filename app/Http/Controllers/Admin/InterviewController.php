<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Interview;
use App\Services\HireflixService;
use GuzzleHttp\Client;

class InterviewController extends Controller
{
    protected $hireflix;

    public function __construct(HireflixService $hireflix)
    {
        $this->hireflix = $hireflix;
    }

    public function index()
    {
        $interviews = Interview::with('application')->get();
        return view('admin.interviews.index', compact('interviews'));
    }

    public function interviews_scheduled()
    {
        $interviews = Interview::with('application', 'application.applicant', 'application.job')->where(['status' => 'scheduled'])->get();
        return view('admin.pages.interviews_scheduled', compact('interviews'));
    }

    public function interviews_assigned()
    {
        $interviews = Interview::with('application', 'application.applicant')->where(['status' => 'assigned'])->get();
        return view('admin.pages.interview_assigned', compact('interviews'));
    }

    public function create($applicationId)
    {
        $application = Application::findOrFail($applicationId);
        return view('admin.interviews.create', compact('application'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required',
            'application_id' => 'required',
            'date' => 'required|date',
            'employer_remarks' => 'nullable|string',
            'status' => 'required',
        ]);

        Interview::create([
            'application_id' => $request->application_id,
            'applicant_id'   => $request->applicant_id,
            'interview_date' => $request->date,
            'employer_remarks' => $request->employer_remarks,
            'status'  => $request->status,
        ]);

        $application = Application::findOrFail($request->application_id);
        $application->status = 'Interview';
        $application->save();

        return redirect()->back()->with('success', 'Interview scheduled successfully.');
    }

    public function edit($id)
    {
        $interview = Interview::findOrFail($id);
        return view('admin.interviews.edit', compact('interview'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'interview_date' => 'required|date',
            'remarks' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,canceled',
        ]);

        $interview = Interview::findOrFail($id);
        $interview->update([
            'interview_date' => $request->date,
            'remarks' => $request->remarks,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Interview updated successfully.');
    }

    public function interveiw_update(Request $request)
    {
        $request->validate([
            'agent_remarks' => 'nullable|string',
            'status' => 'required|in:scheduled,assigned,completed,canceled',
        ]);

        $interview = Interview::findOrFail($request->id);
        $interview->update([
            'agent_remarks' => $request->agent_remarks,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Interview updated successfully.');
    }

    public function destroy($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete();
        return redirect()->route('interviews.index')->with('success', 'Interview deleted successfully.');
    }

    public function startInterview(Request $request, $interviewId)
    {
        $data = [
            'title' => 'Interview for Job XYZ',
            'description' => 'Please complete the video interview',
            'candidates' => [
                [
                    'email' => 'applicant@example.com',
                    'name' => 'John Doe'
                ]
            ],
            // Add other interview details required by Hireflix API
        ];

        $interview = $this->hireflix->createInterview($data);
        dd($interview);
        return response()->json(['message' => 'Interview started', 'interview' => $interview]);
    }

    public function testCreateInterview()
    {
        // Initialize Guzzle HTTP client
        $client = new Client();

        // GraphQL query for testing
        $query = '{
            endpoints {
                path
                description
            }
        }';

        // Make the API request
        try {
            $response = $client->post('https://api.hireflix.com/', [
                'headers' => [
                    'X-API-KEY' => '04a60a5f-8d11-4939-9981-63f2373636a4', // Your Hireflix API key
                    'Content-Type' => 'application/json',
                ],
                'json' => ['query' => $query],
            ]);

            // Get the response body
            $responseBody = json_decode($response->getBody(), true);
            return response()->json($responseBody);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function testHireflixApi()
    {
        // Initialize Guzzle HTTP client
        $client = new Client();

        // GraphQL mutation for creating an interview
        $mutation = 'mutation {
            createInterview(input: {
                title: "Test Video Interview for Job XYZ",
                description: "Please complete your video interview.",
                candidates: [
                    { 
                        email: "applicant@example.com", 
                        name: "John Doe" 
                    }
                ]
            }) {
                id
                title
                status
            }
        }';

        // Make the API request
        try {
            $response = $client->post('https://api.hireflix.com/interview', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-API-KEY' => '04a60a5f-8d11-4939-9981-63f2373636a4', // Include your API key here
                ],
                'json' => ['query' => $mutation],
            ]);

            // Get the response body
            $responseBody = json_decode($response->getBody(), true);
            return response()->json($responseBody);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    
}


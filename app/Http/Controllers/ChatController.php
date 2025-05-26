<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Services\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function createSession()
    {
        $session = ChatSession::create(['user_id' => auth()->id()]);
        return response()->json(['session_id' => $session->id]);
    }

    public function sendMessage(Request $request, ChatService $chatService)
    {
        try {
            $request->validate([
                'session_id' => 'required|exists:chat_sessions,id',
                'message' => 'required|string',
            ]);

            $session = ChatSession::findOrFail($request->session_id);

            ChatMessage::create([
                'chat_session_id' => $session->id,
                'user_id' => auth()->id(),
                'role' => 'user',
                'content' => $request->message,
            ]);

            $assistantReply = $chatService->sendMessage($request->message);

            ChatMessage::create([
                'chat_session_id' => $session->id,
                'role' => 'assistant',
                'content' => $assistantReply,
            ]);

            return response()->json(['reply' => $assistantReply]);
        } catch (\Exception $e) {
            logger()->error('Erreur ChatController@sendMessage', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(ChatSession $chatSession)
    {
        // Optional: delete all related messages first if you have foreign key constraints
        $chatSession->messages()->delete();

        // Delete chat session
        $chatSession->delete();

        return back()->with('success', 'Chat session deleted successfully.');
    }
}

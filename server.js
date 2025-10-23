// server.js
const express = require("express");
const http = require("http");
const { Server } = require("socket.io");

const app = express();
const server = http.createServer(app);

const io = new Server(server, {
	cors: {
		origin: " http://172.16.161.100", // allow CI3 frontend
		methods: ["GET", "POST"],
	},
});
io.on("connection", (socket) => {
	console.log("⚡ Client connected:", socket.id);

	// Listen for messages from CI3 frontend
	socket.on("sendMessage", (data) => {
		console.log("📨 Message received:", data);

		// ✅ Broadcast to ALL clients (including sender)
		io.emit("newMessage", data);
	});

	// ✅ Reactions
	socket.on("sendReaction", (data) => {
		console.log("😊 Reaction received:", data);
		io.emit("newReaction", data); // broadcast reaction to everyone
	});

	// Typing indicator
	socket.on("typing", (data) => {
		// send to everyone *except* the sender
		socket.broadcast.emit("typing", data);
	});

	socket.on("stopTyping", (data) => {
		socket.broadcast.emit("stopTyping", data);
	});

	socket.on("disconnect", () => {0
		console.log("❌ Client disconnected:", socket.id);
	});

    socket.on("conversationDeleted", (data) => {
        io.emit("conversationDeleted", data);
    });

	socket.on("newMessage", (data) => {
		console.log("📩 New message received:", data);

		// Construct PowerShell script dynamically
		const psScript = `
		[void][System.Reflection.Assembly]::LoadWithPartialName("System.Windows.Forms");
		$objNotifyIcon = New-Object System.Windows.Forms.NotifyIcon;
		$objNotifyIcon.Icon = [System.Drawing.SystemIcons]::Information;
		$objNotifyIcon.BalloonTipIcon = "Info";
		$objNotifyIcon.BalloonTipTitle = "Message from ${data.sender_name}";
		$objNotifyIcon.BalloonTipText = "${data.message}";
		$objNotifyIcon.Visible = $True;
		$objNotifyIcon.ShowBalloonTip(7000);
		Start-Sleep 7;
		`;

		exec(`powershell -Command "${psScript.replace(/\n/g, ' ')}"`, (err) => {
			if (err) console.error("⚠️ PowerShell error:", err);
		});
	});
});

server.listen(3000, "0.0.0.0", () => {
	console.log("✅ Socket.IO server running at http:/172.16.161.100:3000");
});

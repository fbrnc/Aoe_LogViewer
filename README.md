# Aoe_LogViewer #

### A very thin and configurable layer between you and your logs :) ###

This is a simple module that enables you to configure logs and commands to display log file in the backend.

Currently only log files and shell commands are supported, but in theory log content could be retrieved from
any source (e.g. databases, GrayLog,...) and other commands could be used to filter and preprocess the data
before being displayed.

#### Adding a new log and commands ####
```xml
<config>
	<global>
		<aoe_logviewer>
			<logs>
				<system.log>
					<label>system.log</label><!-- shows in the drop down -->
					<file_path>###LOGDIR###/system.log</file_path><!-- ###LOGDIR## will be replaced -->
					<model>aoe_logviewer/log_file</model><!-- Aoe_LogViewer_Model_Log_Abstract -->
					<sort_order>10</sort_order>
					<!--<disabled>1</disabled>-->

					<commands>
						<tail>
							<label>Last n lines (newest first)</label><!-- shows in the drop down -->
							<command_string>tail -n %2$s '%1$s' | tac</command_string><!-- %1$s: file, %2$s: number of lines (currently hardcoded) -->
							<model>aoe_logviewer/command_shell</model><!-- must extend Aoe_LogViewer_Model_Command_Abstract -->
							<sort_order>10</sort_order>
							<!--<disabled>1</disabled>-->
						</tail>

						<!-- ... add more commands for the current log here ... -->

					</commands>

				</system.log>

				<!-- ... add more logs here ... -->

			</logs>
		</aoe_logviewer>
	</global>
</config>
```